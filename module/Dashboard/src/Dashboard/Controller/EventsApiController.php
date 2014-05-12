<?php
/**
 * Long polling server for widget's data updates
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\Dao\EventsDao;
use Dashboard\Model\DashboardManager;
use Dashboard\Model\Widget\MessagesWidget;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class EventsApiController extends AbstractRestfulController
{
    /**
     * Creates new events
     *
     * @param  mixed $data Request data
     * @return mixed
     */
    public function create($data)
    {
        $configName = $this->params()->fromRoute('configName');
        $widgetId = $this->params()->fromRoute('widgetId');

        try {
            $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

            $widget = $dashboardManager->getWidget($widgetId);

            if (!$widget instanceof MessagesWidget) {
                $this->getResponse()->setStatusCode(400);
                $response = array('status' => '400', 'message' => 'Posting content to a widget is only available for EventsWidget objects');

                return new JsonModel($response);
            }

            $dao = $widget->getDao();

            if (!$dao instanceof EventsDao) {
                $this->getResponse()->setStatusCode(400);
                $response = array('status' => '400', 'message' => 'Selected EventsWidget needs to use EventsDao');

                return new JsonModel($response);
            }

            $widget->getDao()->addEvent($data['type'], $configName, $widgetId, $data);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(400);
            $response = array('status' => '400', 'message' => $e->getMessage());

            return new JsonModel($response);
        }

        return $this->getResponse()->setStatusCode(201);
    }
}
