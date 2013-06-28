<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

use Dashboard\Document\Message;

class MessagesDao extends AbstractDao {
    /**
     * Returns messages for a given widget currently stored in Cache Adapter
     *
     * @param array $params array storing cache identifier
     * @return array|mixed
     */
    public function fetchMessagesForMessagesWidget(array $params) {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $qb = $dm->createQueryBuilder('Dashboard\Document\Message');

        if ($params['dashboardName'] != 'general') {
            $qb->field('projectName')->equals($params['dashboardName']);
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
     * Saves a new message to the persistent storage
     *
     * @param string $configName     Dashboard configuration name
     * @param string $widgetId       widget id
     * @param string $messageContent new message content
     * @param string $avatar      person's avatar html (optional)
     */
    public function addMessage($configName, $widgetId, $messageContent, $avatar = null) {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');

        $message = new Message();
        $message->setProjectName($configName);
        $message->setWidgetId($widgetId);
        $message->setContent($messageContent);

        if (!is_null($avatar)) {
            $message->setAvatar($avatar);
        }

        $dm->persist($message);
        $dm->flush();
    }

    /**
     * Clears all messages stored for a given MessagesWidget
     *
     * @param string $configName Dashboard configuration name
     * @param string $widgetId   widget id
     */
    public function clearMessages($configName, $widgetId) {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');

        $qb = $dm->createQueryBuilder('Dashboard\Document\Message');

        $qb
            ->remove()
            ->field('projectName')->equals($configName)
            ->field('widgetId')->equals($widgetId)
            ->getQuery()
            ->execute();
    }
}