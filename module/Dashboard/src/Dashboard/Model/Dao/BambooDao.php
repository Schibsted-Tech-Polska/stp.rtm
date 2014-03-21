<?php
namespace Dashboard\Model\Dao;

/**
 * Class HipChatDao
 *
 * @package Dashboard\Model\Dao
 */
class BambooDao extends AbstractDao {

    const BAMBOO_BUILD_REASON_PATTERN = "/<a href=\".*?\">([\w\s]+)(&lt;.*?&gt;)*<\/a>/";
    const BAMBOO_DATE_FORMAT = 'Y-m-d\TG:i:s.uP';
    const WIDGET_DATE_FORMAT = 'Y-m-d H:i:s';
    const BAMBOO_FAILING_STATUS = 'Failed';
    const JENKINS_FAILING_STATUS = 'FAILURE';

    /**
     * Fetch Build status for Bamboo plan
     *
     * @param array $params Params
     * @return array
     */
    public function fetchStatusForBuildWidget(array $params = array()) {
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
            $responseParsed['lastCommitter'] = $this->getCommitterNames($lastBuild['reasonSummary']);
            $responseParsed['currentStatus'] = $this->mapBuildStatusName($lastBuild['buildState']);
            $responseParsed['building'] = false;
            $responseParsed['percentDone'] = 0;

        }
        $buildTime = date_create_from_format(self::BAMBOO_DATE_FORMAT, $lastBuild['buildCompletedTime'])->getTimestamp();
        $responseParsed['lastBuilt'] = date(self::WIDGET_DATE_FORMAT, $buildTime);

        $responseParsed['averageHealthScore'] = $responseParsed['currentStatus'] == self::JENKINS_FAILING_STATUS ? 0 : 100;

        return $responseParsed;
    }

    private function getCommitterNames($triggerReason) {
        preg_match_all(self::BAMBOO_BUILD_REASON_PATTERN, $triggerReason, $matches);
        return implode(", ", $matches[1]);
    }

    private function mapBuildStatusName($bambooStatus) {
        if ($bambooStatus == self::BAMBOO_FAILING_STATUS) {
            return self::JENKINS_FAILING_STATUS;
        }
        return $bambooStatus;
    }

    private function fetchRunningBuilds($params, $auth) {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_JSON, $auth);
    }

    private function getAuth() {
        return $this->getDaoParams()['username'] . ":" . $this->getDaoParams()['password'];
    }
}