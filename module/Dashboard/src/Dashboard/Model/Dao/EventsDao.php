<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EventTypeNotDefined;

class EventsDao extends AbstractDao
{
    /**
     * Returns messages for a given widget currently stored in persistent storage
     *
     * @param  array $params array storing dashboard and widget names and other options
     * @return array|mixed
     */
    public function fetchMessagesForMessagesWidget(array $params)
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $qb = $dm->createQueryBuilder('Dashboard\Document\Message');

        if ($params['dashboardName'] != 'general') {
            $qb->field('projectName')->equals(isset($params['projectName']) ? $params['projectName'] : $params['dashboardName']);
            $qb->field('widgetId')->equals($params['widgetId']);
        }

        if (isset($params['limit'])) {
            $qb->limit($params['limit']);
        }

        $result = $qb
            ->sort('createdAt', 'desc')
            ->hydrate(false)
            ->getQuery()
            ->execute();
        $resultArray = $result->toArray();

        foreach ($resultArray as $key => $message) {
            $resultArray[$key]['createdAt'] = date('Y-m-d H:i:s', $message['createdAt']->sec);
        }

        return $resultArray;
    }

    /**
     * Saves a new event information to the persistent storage
     *
     * @param  string $eventType Event type (to save as a certain Document)
     * @param  string $configName Dashboard configuration name
     * @param  string $widgetId widget id
     * @param  array $data data to put into Event Document
     * @throws Exception\EventTypeNotDefined
     */
    public function addEvent($eventType, $configName, $widgetId, $data)
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');

        $document = '\Dashboard\Document\\' . ucfirst($eventType);
        if (!class_exists($document)) {
            throw new EventTypeNotDefined('Desired event type has no Document class defined.');
        }

        $event = new $document();
        $event->fromArray($data);
        $event->setProjectName($configName);
        $event->setWidgetId($widgetId);

        $dm->persist($event);
        $dm->flush();
    }

    /**
     * Clears all messages stored for a given MessagesWidget
     *
     * @param  string $eventType event type
     * @param  string $configName Dashboard configuration name
     * @param  string $widgetId widget id
     * @throws Exception\EventTypeNotDefined
     */
    public function clearEvents($eventType, $configName, $widgetId)
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');

        $eventDocumentClassname = '\Dashboard\Document\\' . ucfirst($eventType);
        if (!class_exists($eventDocumentClassname)) {
            throw new EventTypeNotDefined('Desired event type has no Document class defined.');
        }

        $qb = $dm->createQueryBuilder('Dashboard\Document\\' . ucfirst($eventType));

        $qb
            ->remove()
            ->field('projectName')->equals($configName)
            ->field('widgetId')->equals($widgetId)
            ->getQuery()
            ->execute();
    }
}
