<?php
return [
    'HadoopDao' => [
        'urls' => [
            'fetchDiskUsageForUsageWidget' => ':baseUrl:/jmx?qry=Hadoop:service=NameNode,name=NameNodeInfo',
        ],
    ],
];
