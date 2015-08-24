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
                            'url' => 'www.godt.no/svp/api/assets',
                            'numberOfErrors' => '8',
                            'lastErrorTime' => '1402337747',
                        ],
                        1 =>
                        [
                            'url' => 'www.godt.no/api/search/recipes',
                            'numberOfErrors' => '4',
                            'lastErrorTime' => '1402338198',
                        ],
                        2 =>
                        [
                            'url' => 'red.vgnett.no/godt-admin/image/upload',
                            'numberOfErrors' => '1',
                            'lastErrorTime' => '1402258823',
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
