<?php
/**
 * All methods used for obtaining data through Jenkins JSON API
 *
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

class JenkinsDao extends AbstractDao
{
    /**
     * Fetches all data necessary for displaying build status widget
     *
     * @param  array $params parameters for assembling proper endpoint URL
     * @return array
     */
    public function fetchStatusForBuildWidget(array $params)
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        $responseParsed['currentStatus'] = $response['lastBuild']['result'];
        $responseParsed['lastBuilt'] = date('Y-m-d H:i:s', $response['lastBuild']['timestamp'] / 1000);
        $responseParsed['lastCommitter'] = $this->getLastCommitter($response['lastBuild']);
        $responseParsed['codeCoverage'] = $this->getCodeCoverage($response['healthReport']);
        $responseParsed['averageHealthScore'] = $this->getAverageHealthScore($response);
        $responseParsed['building'] = $response['lastBuild']['building'];
        $responseParsed['percentDone'] = 0;

        if ($response['lastBuild']['building'] == true) {
            $buildStatus = $this->fetchBuildStatus(array_merge($params, array('buildNumber' => $response['lastBuild']['number'])));
            $responseParsed['percentDone'] = $buildStatus['executor']['progress'];
        }

        return $responseParsed;
    }

    public function fetchBuildStatus(array $params)
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }

    /**
     * Returns the name of of the person who committed the last changed that affected
     * the last build. If the last build was executed without any commits (triggered manually),
     * it returns the build executor's name.
     * In all other cases (theoretically not possible) it returns 'UNKNOWN' string.
     *
     * @param  array $buildInfo - part of the JenkinsDao::fetchStatus() response
     * @return string
     */
    protected function getLastCommitter(array $buildInfo)
    {
        if (isset($buildInfo['culprits']) && count($buildInfo['culprits'])) {
            return $buildInfo['culprits'][0]['fullName'];
        } else {
            if (isset($buildInfo['actions'][0]['causes'][0]) && isset($buildInfo['actions'][0]['causes'][0]['userName'])) {
                return $buildInfo['actions'][0]['causes'][0]['userName'];
            } else {
                return 'UNKNOWN';
            }
        }
    }

    /**
     * Calculates the average of all available job health status indicators.
     *
     * @param  array $jobInfo - JenkinsDao::fetchStatus() response
     * @return float
     */
    protected function getAverageHealthScore(array $jobInfo)
    {
        $averageHealthScore = 0;

        if (isset($jobInfo['healthReport']) && count($jobInfo['healthReport']) > 0) {
            foreach ($jobInfo['healthReport'] as $healthIndicator) {
                $averageHealthScore += $healthIndicator['score'];
            }
            $averageHealthScore /= count($jobInfo['healthReport']);
        }

        return $averageHealthScore;
    }

    /**
     * Returns code coverage for concrete build or null if not specified.
     *
     * @param  array $healthReport Health report data
     * @return null|int
     */
    protected function getCodeCoverage($healthReport)
    {
        $score = null;
        foreach ($healthReport as $data) {
            if (strpos($data['description'], 'Clover Coverage') !== false) {
                $score = $data['score'];
                break;
            }
        }

        return $score;
    }
}
