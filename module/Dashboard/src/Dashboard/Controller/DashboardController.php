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
     * Dashboard action for rtm
     *
     * Renders page with dashboard skeleton.
     *
     * @throws \Whoops\Example\Exception
     * @return array|void
     */
    public function dashboardAction() {
        $configName = $this->params()-> fromRoute('configName');

        /**
         * @var DashboardManager $dashboardManager
         */
        $dashboardManager = $this->serviceLocator->get('DashboardManager');
        $dashboardManager->loadConfig($configName);
        $dashboardManager->init();

        return new ViewModel(array());

    }
}
