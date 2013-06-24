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

class LongPollingController extends AbstractRestfulController {
    /**
     * Create a new resource
     *
     * @param  mixed $data Request data
     * @return mixed
     */
    public function create($data) {
        // TODO: Implement create() method.
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id Request id
     * @return mixed
     */
    public function delete($id) {
        // TODO: Implement delete() method.
    }

    /**
     * Return current data for widgets
     *
     * @param  string $widgetId widget's id
     * @return \Zend\View\Model\JsonModel
     */
    public function get($widgetId) {
        $configName = $this->params()->fromRoute('configName');

        $dashboardManager = new DashboardManager($configName, $this->serviceLocator);

        /* @var AbstractWidget $widget */
        $widget = $dashboardManager->getWidget($widgetId);

        $oldValueHash = $this->params()->fromRoute('oldHash');
        $responseData = $widget->fetchData();

        $result = new JsonModel(array(
            'data' => $responseData,
            'hash' => $widget->getResponseHash(),
            'updateTime' => date("H:i"),
        ));

        return $result;
    }

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList() {
        // TODO: Implement getList(Ō) method.
    }

    /**
     * Update an existing resource
     *
     * @param  mixed $id   Resource id
     * @param  mixed $data Resource data
     * @return mixed
     */
    public function update($id, $data) {
        // TODO: Implement update() method.
    }
}
