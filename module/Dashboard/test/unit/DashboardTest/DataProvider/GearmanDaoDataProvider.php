<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;


trait GearmanDaoDataProvider {
    /**
     * @return array
     */
    public function fetchJobsWithWorkersForQueueWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/Gearman/fetchJobsWithWorkersForQueueWidgetResponse.txt',
                '$expectedDaoResponse' => array (
                    0 =>
                        array (
                            'name' => 'gearman-01.int.vgnett.no',
                            'addr' => 'gearman-01.int.vgnett.no:4730',
                            'up' => true,
                            'version' => 'OK 1.1.8',
                            'workers' =>
                                array (
                                    0 =>
                                        array (
                                            'fd' => '35',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    1 =>
                                        array (
                                            'fd' => '34',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    2 =>
                                        array (
                                            'fd' => '38',
                                            'ip' => '10.84.200.208',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'rose-email',
                                                ),
                                        ),
                                    3 =>
                                        array (
                                            'fd' => '43',
                                            'ip' => '10.84.100.151',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'fd' => '41',
                                            'ip' => '10.84.200.208',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'rose-email',
                                                ),
                                        ),
                                    5 =>
                                        array (
                                            'fd' => '37',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    6 =>
                                        array (
                                            'fd' => '36',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ),
                                        ),
                                    7 =>
                                        array (
                                            'fd' => '42',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'email',
                                                ),
                                        ),
                                    8 =>
                                        array (
                                            'fd' => '33',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'email',
                                                ),
                                        ),
                                    9 =>
                                        array (
                                            'fd' => '39',
                                            'ip' => '10.84.200.170',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    10 =>
                                        array (
                                            'fd' => '40',
                                            'ip' => '10.84.100.107',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ),
                                        ),
                                ),
                            'status' =>
                                array (
                                    'email_1387181709' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                    'uploadToImbo_1387181709' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                    'rose-email' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '2',
                                        ),
                                    'uploadToImbo_1386942369' =>
                                        array (
                                            'in_queue' => '63',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                    'uploadToImbo' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '6',
                                        ),
                                    'email' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '4',
                                        ),
                                    'email_1386942369' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                ),
                        ),
                    1 =>
                        array (
                            'name' => 'vg-dev-01.int.vgnett.no',
                            'addr' => 'vg-dev-01.int.vgnett.no:4730',
                            'up' => true,
                            'version' => 'OK 1.1.8',
                            'workers' =>
                                array (
                                    0 =>
                                        array (
                                            'fd' => '35',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    1 =>
                                        array (
                                            'fd' => '40',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'rose-email_1401273681',
                                                ),
                                        ),
                                    2 =>
                                        array (
                                            'fd' => '36',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo1387269207',
                                                ),
                                        ),
                                    3 =>
                                        array (
                                            'fd' => '33',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'email',
                                                    1 => 'uploadToImbo',
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'fd' => '41',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                ),
                                        ),
                                    5 =>
                                        array (
                                            'fd' => '38',
                                            'ip' => '10.84.100.218',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'rose-email',
                                                ),
                                        ),
                                    6 =>
                                        array (
                                            'fd' => '37',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo1387269207',
                                                    1 => 'email1387269207',
                                                ),
                                        ),
                                    7 =>
                                        array (
                                            'fd' => '34',
                                            'ip' => '10.84.100.153',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo',
                                                ),
                                        ),
                                    8 =>
                                        array (
                                            'fd' => '39',
                                            'ip' => '127.0.0.1',
                                            'id' => '-',
                                            'abilities' =>
                                                array (
                                                    0 => 'uploadToImbo1387269207',
                                                ),
                                        ),
                                ),
                            'status' =>
                                array (
                                    'uploadToImbo1387269207' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '3',
                                        ),
                                    'rose-email_1401282314' =>
                                        array (
                                            'in_queue' => '12',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                    'rose-email' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ),
                                    'rose-email_1401273681' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ),
                                    'uploadToImbo' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '3',
                                        ),
                                    'uploadToImbo_1396943049' =>
                                        array (
                                            'in_queue' => '1683',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                    'email' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ),
                                    'email1387269207' =>
                                        array (
                                            'in_queue' => '0',
                                            'jobs_running' => '0',
                                            'capable_workers' => '1',
                                        ),
                                    'rose-email_1401353694' =>
                                        array (
                                            'in_queue' => '1',
                                            'jobs_running' => '0',
                                            'capable_workers' => '0',
                                        ),
                                ),
                        ),
                ),
            ],
        ];
    }
}
