<?php
/**
 * All methods used for obtaining data through Jenkins JSON API
 *
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

class TeamcityDao extends AbstractDao {
    private $_usersMap = null;

    public function fetchStatusForMessagesWidget(array $params) {
        $result = array();

        //$builds = $this->fetchRecentBuilds($params);
        $changes = $this->fetchRecentChanges($params);
        
        foreach ($changes as $change) {
            $result[] = array(
                'author'		=> $this->fetchUserName($params, $change['@attributes']['username']),
                'content' 		=> $change['comment'],
                'createdAtDate'	=> date('Y-m-d', strtotime($change['@attributes']['date'])),
                'createdAtTime'	=> date('H:i:s', strtotime($change['@attributes']['date'])),
                'revision'		=> $change['@attributes']['version']
            );
        }
        
        return $result;
    }

    /**
     * Fetches all data necessary for displaying build status widget
     *
     * @param array $params parameters for assembling proper endpoint URL
     * @return array
     */
    public function fetchStatusForBuildWidget(array $params) {
        $result = array();
        
        $build = $this->fetchFinishedBuildStatus($params);
        $result['currentStatus'] = $build['@attributes']['status'];
        $result['lastBuilt'] = date('Y-m-d H:i:s', strtotime($build['startDate']));
        $result['lastCommitter'] = $this->getLastCommitter($params, $build);
        $result['codeCoverage'] = $this->getCodeCoverage($params, $build);
        $result['averageHealthScore'] = $this->getAverageHealthScore($params, $build);
        
        $result['building'] = false;
        $result['percentDone'] = 0;
        
        // Check building status
        $build = $this->fetchRunningBuildStatus($params);	
        if (!empty($build)) {
            $result['building'] = true;
            $result['percentDone'] = $build['@attributes']['percentageComplete'];
        }

        return $result;
    }

    public function fetchUserName(array $params, $name) {
        if ($this->_usersMap == null) {
            $this->_usersMap = array();
            $response = (array)$this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML)->xpath('//user/@href');
            
            foreach ($response as $href) {
                $url = $params['baseUrl'] . ((string)$href);
                $user = $this->request($url, $params, self::RESPONSE_IN_XML);
                
                $vcsName = @(string)$user->xpath('/user/properties/property[@name="plugin:vcs:tfs:anyVcsRoot"]/@value')[0];
                $userName = @(string)$user->xpath('/user/@name')[0];
                
                if (!empty($vcsName) && !empty($userName)) {
                    $this->_usersMap[$vcsName] = $userName;
                }
            }
        }
        
        if (!empty($this->_usersMap[$name])) {
            return $this->_usersMap[$name];
        }
        
        return $name;
    }
    
    public function fetchForImageWidget(array $params) {
        $result = array();
        $result['url'] = $this->fetchBurnoutImgUrl($params);
        
        return $result;
    }
    
    private function fetchBurnoutImgUrl(array $params) {
        try {
            $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_AS_IS);
        
            if ($response->getStatusCode() == 200){
                return sprintf('data:image/png;base64,%s', base64_encode($response->getBody()));
            }
        } catch (Exception $e) {
            // supress it
        }
        return null;
    }
    
    private function fetchFinishedBuildStatus(array $params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        $build = (array)$response->build[0];
        $build = $build['@attributes'];
        
        return $this->fetchDetailedBuildStatusById($params, $build['id']);
    }
    
    private function fetchRunningBuildStatus(array $params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        $build = (array)$response->build[0];
        
        return $build;
    }

    private function fetchDetailedBuildStatusById(array $params, $id) {
        $params = $params + array('id' => $id);
    
        $response = (array)$this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        $build = (array)$response;
        
        return $build;
    }
    
    private function fetchChangeByRevision(array $params, $revision) {
        $params = $params + array('revision' => $revision);
    
        $response = (array)$this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        $change = (array)$response;
        
        return $change;
    }

    private function fetchCoverageById(array $params, $id) {
        $params = $params + array('id' => $id);
    
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_HTML);
        $result = $response->xpath('//body//table[@class="coverageStats"][1]//tr[2]/td[4]/span[@class="percent"][1]')[0];
        return trim((string)$result);
    }

    private function fetchAverageHealthScore(array $params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        
        $totalCount = (int)(string)$response->xpath('@count')[0];
        $successCount = count($response->xpath('//build[@status="SUCCESS"]'));
        
        $result = 100 * $successCount / $totalCount;
        
        return $result;
    }
    
    private function fetchRecentBuilds(array $params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        
        print_r($response);die();
    }
    
    private function fetchRecentChanges(array $params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
        $revisions = (array)$response->xpath('//change/@version');
        
        $result = array();
        foreach ($revisions as $revision) {
            $result[] = $this->fetchChangeByRevision($params, (string)$revision);
        }
        
        return $result;
    }
    
    /**
     * Returns the name of of the person who committed the last changed that affected
     * the last build. If the last build was executed without any commits (triggered manually),
     * it returns the build executor's name.
     * In all other cases (theoretically not possible) it returns 'UNKNOWN' string.
     *
     * @param array $buildInfo - part of the JenkinsDao::fetchStatus() response
     * @return string
     */
    private function getLastCommitter(array $params, array $build) {
        $username = 'UNKNOWN';
        $revision = (array)$build['revisions']->revision;
        $revision = $revision['@attributes']['version'];
        $change = $this->fetchChangeByRevision($params, $revision);
        
        if (!empty($change)) {
            $username = $this->fetchUserName($params, $change['@attributes']['username']);
        }
        
        /*if (!empty($build['triggered']) && $build['triggered']['@attributes']['type'] == 'vcs') {
        
        }*/
        
        return $username;
    }

    /**
     * Calculates the average of all available job health status indicators.
     *
     * @param array $jobInfo - JenkinsDao::fetchStatus() response
     * @return float
     */
    private function getAverageHealthScore(array $params, array $build) {
        $averageHealthScore = $this->fetchAverageHealthScore($params);

        return $averageHealthScore;
    }

    /**
     * Returns code coverage for concrete build or null if not specified.
     *
     * @param array $healthReport Health report data
     * @return null|int
     */
    private function getCodeCoverage(array $params, array $build) {
        try {
            $coverage = $this->fetchCoverageById($params, $build['@attributes']['id']);
            $coverage = (float)str_replace('%', '', $coverage);
        
            return $coverage;
        } catch (\Exception $e) {
            return null;
        }
    }
}
