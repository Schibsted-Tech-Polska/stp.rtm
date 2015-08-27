<?php
/**
 * Default controller for displaying rtm dashboard.
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\DashboardManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController
{
    /**
     * Renders page with dashboard skeleton.
     *
     * @throws \Whoops\Example\Exception
     * @return array|void
     */
    public function dashboardAction()
    {
        $configName = $this->params()->fromRoute('configName');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        $this->layout()->setVariable('widgetTypes', $dashboardManager->getWidgetTypes());
        $this->layout()->setVariable('theme', $dashboardManager->getThemeName());

        return new ViewModel(['widgets' => $dashboardManager->getWidgets(), 'configName' => $configName]);
    }
}
