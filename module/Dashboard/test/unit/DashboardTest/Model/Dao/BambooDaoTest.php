<?php
namespace DashboardTest\Model\Dao;

class BambooDaoTest extends AbstractBambooDao
{
    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->setDaoOptions([
            'params' => [
                'baseUrl' => 'http://bamboo.aftonbladet.se:8085',
            ],
        ]);
    }
}
