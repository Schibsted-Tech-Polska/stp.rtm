<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;


trait Bamboo4DaoDataProvider
{
    /**
     * @return array
     */
    public function fetchStatusForBuildWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$runningBuildsResponse' =>
                    __DIR__ . '/../Mock/Dao/Bamboo4/fetchRunningBuildsResponse.txt',
                'fetchStatusForBuildWidgetDataProvider' =>
                    __DIR__ . '/../Mock/Dao/Bamboo4/fetchStatusForBuildWidgetResponse.txt',
                '$expectedDaoResponse' => array(
                    'lastCommitter' => 'Updated by Austin Powers',
                    'currentStatus' => 'Successful',
                    'building' => false,
                    'percentDone' => 0,
                    'lastBuilt' => '2009-06-15 05:14:10',
                    'averageHealthScore' => 100,
                ),
            ],
        ];
    }
}
