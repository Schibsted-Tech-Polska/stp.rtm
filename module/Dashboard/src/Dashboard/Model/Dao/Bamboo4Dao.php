<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

class Bamboo4Dao extends BambooDao
{
    /**
     * Fetch Build status for Bamboo plan
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchStatusForBuildWidget(array $params = array())
    {
        $responseParsed = array();

        $auth = $this->getAuth();
        $runningBuilds = $this->fetchRunningBuilds($params, $auth);
        $lastBuildJson = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_JSON, $auth);
        $lastBuild = $lastBuildJson['results']['result'][0];

        if (!empty($runningBuilds['builds'])) {
            $latestRunningBuild = $runningBuilds['builds'][0];
            $responseParsed['percentDone'] = $latestRunningBuild['percentageComplete'];
            $responseParsed['currentStatus'] = null;
            $responseParsed['lastCommitter'] = $this->getCommitterNames($latestRunningBuild['triggerReason']);
            $responseParsed['building'] = true;
        } else {
            $responseParsed['lastCommitter'] = $this->getCommitterNames($lastBuild['buildReason']);
            $responseParsed['currentStatus'] = $this->mapBuildStatusName($lastBuild['state']);
            $responseParsed['building'] = false;
            $responseParsed['percentDone'] = 0;

        }
        $buildTime = date_create_from_format(
            self::BAMBOO_DATE_FORMAT,
            $lastBuild['buildCompletedTime']
        )->getTimestamp();
        $responseParsed['lastBuilt'] = gmdate(self::WIDGET_DATE_FORMAT, $buildTime);

        if ($responseParsed['currentStatus'] == self::JENKINS_FAILING_STATUS) {
            $responseParsed['averageHealthScore'] = 0;
        } else {
            $responseParsed['averageHealthScore'] = 100;
        }

        return $responseParsed;
    }
}
