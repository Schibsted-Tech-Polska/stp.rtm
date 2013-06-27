<?php
/**
 * Long polling server for widget's data updates
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Controller;

use Dashboard\Model\Dao\MessagesDao;
use Dashboard\Model\DashboardManager;
use Dashboard\Model\Widget\MessagesWidget;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractRestfulController {
    /**
     * Creates new messages
     *
     * @param  mixed $data Request data
     * @return mixed
     */
    public function create($data) {
        $configName = $this->params()->fromRoute('configName');
        $widgetId = $this->params()->fromRoute('widgetId');

        try {
            $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

            $widget = null;
            $widget = $dashboardManager->getWidget($widgetId);

            if (!$widget instanceof MessagesWidget) {
                $this->getResponse()->setStatusCode(400);
                $response = array('code' => '400', 'message' => 'Posting content to a widget is only available for MessagesWidget objects');

                return new JsonModel($response);
            }

            $dao = $widget->getDao();

            if (!$dao instanceof MessagesDao) {
                $this->getResponse()->setStatusCode(400);
                $response = array('code' => '400', 'message' => 'Selected MessagesWidget needs to use MessagesDao');

                return new JsonModel($response);
            }

            $widget->getDao()->addMessage($configName, $widgetId, $data['message']);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(400);
            $response = array('code' => '400', 'message' => $e->getMessage());

            return new JsonModel($response);
        }

        return $this->getResponse()->setStatusCode(201);
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id Request id
     * @return mixed
     */
    public function delete($id) {
        return $this->getResponse()->setStatusCode(405);
    }

    /**
     * Return current data for widgets
     *
     * @param  string $widgetId widget's id
     * @return \Zend\View\Model\JsonModel
     */
    public function get($id) {
        return $this->getResponse()->setStatusCode(405);
    }

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList() {
        return $this->getResponse()->setStatusCode(405);
    }

    /**
     * Update an existing resource
     *
     * @param  mixed $id   Resource id
     * @param  mixed $data Resource data
     * @return mixed
     */
    public function update($id, $data) {
        return $this->getResponse()->setStatusCode(405);
    }
}
