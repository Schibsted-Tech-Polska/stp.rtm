<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;


trait SmogDaoDataProvider {
    /**
     * @return array
     */
    public function fetchForSmogWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/Smog/fetchForSmogWidgetResponse.txt',
                '$expectedDaoResponse' => array (
                    0 =>
                        array (
                            'name' => 'Dwutlenek siarki (SO 2)',
                            'norm' => 350.0,
                            'unit' => 'ug/m 3',
                            'value' => 4.0,
                            'percent' => 1.1428571428571428,
                            'parameter' => 'SO 2',
                        ),
                    1 =>
                        array (
                            'name' => 'Dwutlenek azotu (NO 2)',
                            'norm' => 200.0,
                            'unit' => 'ug/m 3',
                            'value' => 101.0,
                            'percent' => 50.5,
                            'parameter' => 'NO 2',
                        ),
                    2 =>
                        array (
                            'name' => 'Tlenek wÄgla (CO)',
                            'norm' => 10000,
                            'unit' => 'mg/m 3',
                            'value' => 0.69,
                            'percent' => 0.0069,
                            'parameter' => 'CO',
                        ),
                )
            ],
        ];
    }
}
