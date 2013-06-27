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
        $theme = $this->params()->fromRoute('theme');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        $this->layout()->setVariable('widgetTypes', $dashboardManager->getWidgetTypes());
        $this->layout()->setVariable('theme', isset($theme) ? $theme:'dark');

        return new ViewModel(array('widgets' => $dashboardManager->getWidgets(), 'configName' => $configName));
    }

    /**
     * Method for adding messages to Messages Widgets
     *
     * @return \Zend\Stdlib\ResponseInterface
     * @throws \Exception
     */
    public function addMessageAction() {
        $configName = $this->params()->fromRoute('configName');
        $widgetId = $this->params()->fromRoute('widgetId');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        $widget = $dashboardManager->getWidget($widgetId);
        if (!$widget instanceof MessagesWidget) {
            throw new \Exception('Posting content to a widget is only available for MessagesWidget objects');
        }

        $dao = $widget->getDao();

        if (!$dao instanceof MessagesDao) {
            throw new \Exception('Selected MessagesWidget needs to use MessagesDao');
        }

        $widget->getDao()->addMessage($configName, $widgetId, $this->params()->fromPost('message'));

        return $this->getResponse();
    }
}