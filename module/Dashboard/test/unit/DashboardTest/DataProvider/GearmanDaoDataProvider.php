<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;

trait GearmanDaoDataProvider
{
    /**
     * @return array
     */
    public function fetchJobsWithWorkersForGearmanWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/Gearman/fetchJobsWithWorkersForGearmanWidgetResponse.txt',
                '$expectedDaoResponse' => [
                    0 =>
                        [
                            'name' => 'gearman-01.int.vgnett.no',
                            'addr' => 'gearman-01.int.vgnett.no:4730',
                            'up' => true,
                            'version' => 'OK 1.1.8',
                            'workers' =>
                                [
                                    0 =>
                                        [
                                            'fd' => '35',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        1 =>
                                        [
                                            'fd' => '34',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        2 =>
                                        [
                                            'fd' => '38',
                                            'ip' => '10.84.200.208',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'rose-email',
                                                ],
                                        ],
                                        3 =>
                                        [
                                            'fd' => '43',
                                            'ip' => '10.84.100.151',
                                            'id' => '-',
                                            'abilities' =>
                                                [],
                                        ],
                                        4 =>
                                        [
                                            'fd' => '41',
                                            'ip' => '10.84.200.208',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'rose-email',
                                                ],
                                        ],
                                        5 =>
                                        [
                                            'fd' => '37',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        6 =>
                                        [
                                            'fd' => '36',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ],
                                        ],
                                        7 =>
                                        [
                                            'fd' => '42',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'email',
                                                ],
                                        ],
                                        8 =>
                                        [
                                            'fd' => '33',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'email',
                                                ],
                                        ],
                                        9 =>
                                        [
                                            'fd' => '39',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        10 =>
                                        [
                                            'fd' => '40',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ],
                                        ],
                                ],
                                'status' =>
                                [
                                    'email_1387181709' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                        'uploadToImbo_1387181709' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                        'rose-email' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '2',
                                        ],
                                        'uploadToImbo_1386942369' =>
                                        [
                                            'in_queue' => '63',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                        'uploadToImbo' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '6',
                                        ],
                                        'email' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '4',
                                        ],
                                        'email_1386942369' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                ],
                        ],
                        1 =>
                        [
                            'name' => 'vg-dev-01.int.vgnett.no',
                            'addr' => 'vg-dev-01.int.vgnett.no:4730',
                            'up' => true,
                            'version' => 'OK 1.1.8',
                            'workers' =>
                                [
                                    0 =>
                                        [
                                            'fd' => '35',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        1 =>
                                        [
                                            'fd' => '40',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'rose-email_1401273681',
                                                ],
                                        ],
                                        2 =>
                                        [
                                            'fd' => '36',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo1387269207',
                                                ],
                                        ],
                                        3 =>
                                        [
                                            'fd' => '33',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ],
                                        ],
                                        4 =>
                                        [
                                            'fd' => '41',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                [],
                                        ],
                                        5 =>
                                        [
                                            'fd' => '38',
                                            'ip' => '10.84.100.218',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'rose-email',
                                                ],
                                        ],
                                        6 =>
                                        [
                                            'fd' => '37',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo1387269207',
                                                    1 => 'email1387269207',
                                                ],
                                        ],
                                        7 =>
                                        [
                                            'fd' => '34',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo',
                                                ],
                                        ],
                                        8 =>
                                        [
                                            'fd' => '39',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                [
                                                    0 => 'uploadToImbo1387269207',
                                                ],
                                        ],
                                ],
                                'status' =>
                                [
                                    'uploadToImbo1387269207' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '3',
                                        ],
                                        'rose-email_1401282314' =>
                                        [
                                            'in_queue' => '12',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                        'rose-email' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ],
                                        'rose-email_1401273681' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ],
                                        'uploadToImbo' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '3',
                                        ],
                                        'uploadToImbo_1396943049' =>
                                        [
                                            'in_queue' => '1683',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                        'email' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ],
                                        'email1387269207' =>
                                        [
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ],
                                        'rose-email_1401353694' =>
                                        [
                                            'in_queue' => '1',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ],
                                ],
                        ],
                ],
            ],
        ];
    }
}
