<?php
/**
 * Default controller for displaying rtm dashboard.
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\Dao\MessagesDao;
use Dashboard\Model\DashboardManager;
use Dashboard\Model\Widget\MessagesWidget;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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

        return new ViewModel(array('widgets' => $dashboardManager->getWidgets(), 'configName' => $configName));
    }

    public function addMessageAction() {
        $configName = $this->params()->fromRoute('configName');
        $widgetId = $this->params()->fromRoute('widgetId');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        /* @var AbstractWidget $widget */
        $widget = $dashboardManager->getWidget($widgetId);
        if (!$widget instanceof MessagesWidget) {
            throw new \Exception('Posting content to a widget is only available for MessagesWidget objects');
        }

        $dao = $widget->getDao();

        if (!$dao instanceof MessagesDao) {
            throw new \Exception('Selected MessagesWidget needs to use MessagesDao');
        }

        $widget->getDao()->addMessage($widget->getCacheIdentifier(), $this->params()->fromPost('message'));

        return $this->getResponse();
    }
}