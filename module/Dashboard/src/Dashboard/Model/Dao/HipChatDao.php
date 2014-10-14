<?php
namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;

/**
 * Class HipChatDao
 *
 * @package Dashboard\Model\Dao
 */
class HipChatDao extends AbstractDao
{
    private $stripChars = array('\n');

    /**
     * Fetch HipChat messages
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchListRecentMessagesForMessagesWidget(array $params = array())
    {
        if (!isset($params['room'])) {
            throw new EndpointUrlNotAssembled('You need to specify room name');
        }

        $daoParams = $this->getDaoParams();
        $hipChatJson = $this->request($this->config['urls']['listRecentMessages'], array(
            'room_id' => $params['room'],
            'auth_token' => $daoParams['auth_token'],
        ), 'json', true);

        if ($hipChatJson && isset($hipChatJson['messages'])) {
            $returnArray = array();
            foreach (array_reverse($hipChatJson['messages']) as $message) {
                if (isset($params['fromUser'])) {
                    if (!is_array($params['fromUser'])) {
                        $params['fromUser'] = array($params['fromUser']);
                    }

                    if (in_array($message['from']['name'], $params['fromUser'])) {
                        $returnArray[] = array(
                            'projectName' => $message['from']['name'],
                            'createdAt' => (new \DateTime($message['date']))->format('Y-m-d H:i:s'),
                            'content' => str_replace($this->stripChars, '',$message['message']),
                        );
                    }
                } else {
                    $returnArray[] = array(
                        'projectName' => $message['from']['name'],
                        'createdAt' => (new \DateTime($message['date']))->format('Y-m-d H:i:s'),
                        'content' => str_replace($this->stripChars, '',$message['message']),
                    );
                }
            }

            return array_slice($returnArray, 0, $params['limit']);
        } else {
            return array();
        }
    }
}
