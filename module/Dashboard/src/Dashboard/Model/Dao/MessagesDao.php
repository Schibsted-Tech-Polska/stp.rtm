<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


class MessagesDao extends AbstractDao {
    /**
     * Returns messages for a given widget currently stored in Cache Adapter
     *
     * @param array $params array storing cache identifier
     * @return array|mixed
     */
    public function fetchMessagesForMessagesWidget(array $params) {
        $key    = $params['cacheIdentifier'];

        $result = $this->getCacheAdapter()->getItem($key, $success);
        if (!$success) {
            $result = array();
            $this->getCacheAdapter()->setItem($key, $result);
        }

        if (isset($params['limit'])) {
            $result = array_slice($result, 0, $params['limit']);
        }

        return $result;
    }

    /**
     * Adds a new message to a given MessagesWidget
     * @param string $cacheIdentifier cache identifier key
     * @param string $message message to be added
     */
    public function addMessage($cacheIdentifier, $message) {
        $result = $this->getCacheAdapter()->getItem($cacheIdentifier, $success);

        if (!$success) {
            $result = array();
        }

        array_unshift($result, array(
                'createdAt' => date('Y-m-d H:i:s'),
                'content' => $message,
            )
        );

        $this->getCacheAdapter()->setItem($cacheIdentifier, $result);
    }

    /**
     * Clears all messages stored for a given MessagesWidget
     * @param string $cacheIdentifier cache identifier key
     */
    public function clearMessages($cacheIdentifier) {
        $this->getCacheAdapter()->removeItem($cacheIdentifier);
    }
}