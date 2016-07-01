<?php
/**
 * All methods used for obtaining data through GoCD REST API
 *
 * @author Łukasz Jankowski <lukasz.jankowski@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;

class GoCDDao extends AbstractDao
{
    const SUCCESS = 'SUCCESS';
    const FAILURE = 'FAILURE';
    const BUILDING = 'Building';
    const PASSED = 'Passed';
    const ASSIGNED = 'Assigned';
    const SCHEDULED = 'Scheduled';
    const PREPARING = 'Preparing';
    const CANCELLED = 'Cancelled';

    /**
     * Fetches all data necessary for displaying build status widget
     *
     * @param  array $params parameters for assembling proper endpoint URL
     * @return array
     * @throws \RuntimeException
     */
    public function fetchStatusForBuildWidget(array $params)
    {
        if (!isset($params['job']) || empty($params['job'])) {
            throw new \RuntimeException('Invalid job configuration');
        }

        $page = 0;

        do {
            // adding /:offset indicating the number of pipeline instances to be skipped
            $endpointUrl = sprintf('%s/%d', $this->getEndpointUrl(__FUNCTION__), $page * 10);
            $responseParsed = $this->getPipelineHistory($endpointUrl, $params);
            $page++;
        } while ($page < 10 && !$responseParsed);

        if (!$responseParsed) {
            $msg = sprintf(
                'Job \'%s\'defined in configuration not found in response', json_encode($params['job'])
            );
            throw new \RuntimeException($msg);
        }

        return $responseParsed;
    }

    /**
     * Get pipeline history for page number given in $endpointUrl
     *
     * @param   string $endpointUrl Endpoint URL with pagination
     * @param   array $params parameters for assembling proper endpoint URL
     * @return  array
     * @throws  EndpointUrlNotAssembled
     */
    private function getPipelineHistory($endpointUrl, array $params)
    {
        $response = $this->request($endpointUrl, $params);

        if (!isset($response['pipelines']) || !isset($response['pipelines'][0])) {
            throw new EndpointUrlNotAssembled('No pipeline data in response');
        }

        $responseParsed = [];

        foreach ($response['pipelines'] as $pipeline) {
            foreach ($pipeline['stages'] as $stage) {
                foreach ($stage['jobs'] as $job) {
                    if ($params['job'] == $job['name']) {
                        $inProgressStates = [self::BUILDING, self::ASSIGNED, self::SCHEDULED, self::PREPARING];
                        if (in_array($job['state'], $inProgressStates)) {
                            $responseParsed['currentStatus'] = null; // in progress
                        } else {
                            $responseParsed['currentStatus'] = self::PASSED == $job['result']
                                ? self::SUCCESS : self::FAILURE;
                        }
                        $responseParsed['building'] = self::BUILDING == $job['state'];
                        $responseParsed['lastBuilt'] = gmdate('Y-m-d H:i:s', $job['scheduled_date'] / 1000);
                        $responseParsed['lastCommitter'] = $this->getLastCommitter($pipeline['build_cause']['material_revisions']);

                        // not supported by GoCD
                        $responseParsed['averageHealthScore'] = self::SUCCESS == $responseParsed['currentStatus']
                            ? 100 : (self::FAILURE == $responseParsed['currentStatus'] ? 0 : null);
                        $responseParsed['percentDone'] = $responseParsed['building'] ? 0 : 100;

                        break 3;
                    }
                }
            }
        }

        return $responseParsed;
    }

    /**
     * Returns the name of of the person who committed the last changed that affected
     * the last build. If the last build was executed without any commits (triggered manually),
     * it returns the build executor's name.
     * In all other cases (theoretically not possible) it returns 'UNKNOWN' string.
     *
     * @param  array $materialRevisions - part of the self::fetchStatusForBuildWidget() response
     * @return string
     */
    private function getLastCommitter($materialRevisions)
    {
        $commiterInfo = '';

        foreach ($materialRevisions as $materialRevision) {
            $commiterInfo .= sprintf('%s: ', $this->getMaterialName($materialRevision['material']['description']));
            foreach ($materialRevision['modifications'] as $modification) {
                $commiterInfo .= sprintf('%s, ', $modification['user_name']);
            }
            $commiterInfo = rtrim($commiterInfo, ', ');
            $commiterInfo .= '<br />';
        }
        $commiterInfo = rtrim($commiterInfo, '<br />');

        return $commiterInfo;
    }

    /**
     * Extract material name from its description, or 'UNKNOWN' string if unable to extract.
     *
     * @param string $materialDescription
     * @return string
     */
    private function getMaterialName($materialDescription)
    {
        $matches = [];
        preg_match('/git@.+\/(.+)\.git/', $materialDescription, $matches);

        return isset($matches[1]) ? $matches[1] : 'UNKNOWN';
    }
}
