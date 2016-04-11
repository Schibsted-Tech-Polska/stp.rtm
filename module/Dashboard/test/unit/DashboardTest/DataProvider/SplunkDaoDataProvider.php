<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;

trait SplunkDaoDataProvider
{
    /**
     * @return array
     */
    public function fetchFivehundredsForAlertWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/Splunk/fetchFivehundredsForAlertWidgetDataProviderResponse.txt',
                '$expectedDaoResponse' => [
                    0 =>
                        [
                            'url' => 'www.vektklubb.no/dagbok/edit/',
                            'count' => '1',
                            'latestTime' => '1454874000',
                        ],
                ],
            ],
            'wrong result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/Splunk/fetchFivehundredsForAlertWidgetDataProviderResponseFailure.txt',
                '$expectedDaoResponse' => [],
            ],
        ];
    }
}
