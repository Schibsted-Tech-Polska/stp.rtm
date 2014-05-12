<?php
namespace Dashboard\Model\Dao;

/**
 * Class HipChatDao
 *
 * @package Dashboard\Model\Dao
 */
class HipChatDao extends AbstractDao
{
    /**
     * Fetch HipChat messages
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchListRecentMessagesForMessagesWidget(array $params = array())
    {
        $daoParams = $this->getDaoParams();
        $hipChatJson = $this->request($this->config['urls']['listRecentMessages'], array(
            'room_id' => $params['room'],
            'auth_token' => $daoParams['auth_token'],
        ), 'json', true);

        if ($hipChatJson) {
            $returnArray = array();
            foreach (array_reverse($hipChatJson['messages']) as $message) {
                $returnArray[] = array(
                    'projectName' => $message['from']['name'],
                    'createdAt' => (new \DateTime($message['date']))->format('Y-m-d H:i:s'),
                    'content' => $message['message'],
                );
            }

            return array_slice($returnArray, 0, $params['limit']);
        } else {
            return array();
        }
    }
}
