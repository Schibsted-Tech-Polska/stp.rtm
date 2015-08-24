<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\BambooDaoDataProvider;

class BambooDaoTest extends AbstractBambooDao
{
    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->setDaoOptions([
            'params' => [
                'baseUrl' => 'http://bamboo.aftonbladet.se:8085'
            ]
        ]);
    }
}
