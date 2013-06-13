<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\DashboardManager;
use Whoops\Example\Exception;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;

class DashboardController extends AbstractActionController {
    /**
     * Renders page with dashboard skeleton.
     *
     * @throws \Whoops\Example\Exception
     * @return array|void
     */
    public function dashboardAction() {
        $configName = $this->params()->fromRoute('configName');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        $widget = $dashboardManager->getWidget('notifaveRpm');
        $widget2 = $dashboardManager->getWidget('buildStatus');

        var_dump($widget->fetchData());
        var_dump($widget2->fetchData());

        return new ViewModel(array());
    }
}
