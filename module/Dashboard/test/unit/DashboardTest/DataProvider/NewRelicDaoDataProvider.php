<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;


trait NewRelicDaoDataProvider
{
    /**
     * @return array
     */
    public function fetchRpmForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchRpmForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 775,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchFeRpmForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchFeRpmForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 7908.0,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchErrorRateForErrorWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 0,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchApdexForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 0.99,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchApdexForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "0.99",
                    'events' => [],
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchCpuUsageForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchCpuUsageForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 26.8,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchAverageResponseTimeForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchAverageResponseTimeForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 135.0,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchMemoryForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 87.8,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchMemoryForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "87.8",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchCpuFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 15.8,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchCpuFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "15.8",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchDBFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 1.76,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchDBFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "1.76",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchThroughputFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 252,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchThroughputFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "252",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchResponseTimeFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 134,
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchResponseTimeFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "134",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchEventsDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchEventsResponse.txt',
                '$expectedDaoResponse' => [
                    [
                        'title' => 'michald deployed revision 4701',
                        'date' => '1400765104',
                        'type' => 'deployment'
                    ],
                    [
                        'title' => 'anmaciur deployed revision 4697',
                        'date' => '1400587640',
                        'type' => 'deployment'
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function fetchThresholdDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/NewRelic/fetchThresholdResponse.txt',
                '$expectedDaoResponse' => [
                    'id' => '500035',
                    'type' => 'Apdex',
                    'caution-value' => '0.85',
                    'critical-value' => '0.7',
                    'url' => 'https://rpm.newrelic.com/api/v1/accounts/100366/applications/1716240/thresholds/500035',
                ],
            ],
        ];
    }
}
