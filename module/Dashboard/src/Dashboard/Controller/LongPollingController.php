<?php
/**
 * Long polling server for widget's data updates
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\DashboardManager;
use Dashboard\Model\Widget\AbstractWidget;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class LongPollingController extends AbstractRestfulController
{
    /**
     * Return current data for widgets
     *
     * @param  string $widgetId widget's id
     * @return \Zend\View\Model\JsonModel
     */
    public function get($widgetId)
    {
        $responseData = null;
        $configName = $this->params()->fromRoute('configName');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator, $widgetId);

        /* @var AbstractWidget $widget */
        $widget = $dashboardManager->getWidget($widgetId);

        try {
            $responseData = $widget->fetchData();

            $result = new JsonModel(array(
                'data' => $responseData,
                'hash' => $widget->getResponseHash(),
                'updateTime' => date("H:i"),
            ));
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(400);
            $result = new JsonModel(array(
                'error' => array(
                    'message' => $e->getMessage(),
                    'type' => $e->getCode(),
                ),
                'data' => '',
                'hash' => $widget->getResponseHash(),
                'updateTime' => date("H:i"),
            ));
        }

        return $result;
    }
}
