<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Whoops\Example\Exception;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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

        $configFilePath = 'config/' . $configName . '.config.php';

    }
}
