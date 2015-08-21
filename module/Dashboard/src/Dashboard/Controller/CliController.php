<?php

namespace Dashboard\Controller;

use Dashboard\Model\AnalyzerRunner;
use Dashboard\Model\DashboardManager;
use Zend\Mvc\Controller\AbstractActionController;

class CliController extends AbstractActionController
{
    public function listenAggregatedAction()
    {
        $configName = $this->params()->fromRoute('configName');
        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);
        $analyzer = new AnalyzerRunner($dashboardManager);
        $analyzer->runAggregated();
    }

    public function listenAction()
    {
        $configName = $this->params()->fromRoute('configName');
        $widgetId = $this->params()->fromRoute('widgetId');
        $dashboardManager = new DashboardManager($configName, $this->serviceLocator, $widgetId);
        $analyzer = new AnalyzerRunner($dashboardManager);
        $analyzer->run($widgetId);
    }
}
