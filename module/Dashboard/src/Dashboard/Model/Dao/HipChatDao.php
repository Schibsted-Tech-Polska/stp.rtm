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

    /**
     * Fetch HipChat messages
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchNewListRecentMessagesForMessagesWidget(array $params = array())
    {
        $returnArray = [];

        if (!isset($params['room'])) {
            throw new EndpointUrlNotAssembled('You need to specify room name');
        }

        $daoParams = $this->getDaoParams();
        $hipChatJson = $this->request($this->config['urls']['newListRecentMessages'], array(
            'room_id' => $params['room'],
            'auth_token' => $daoParams['auth_token'],
        ), 'json');

        if ($hipChatJson && isset($hipChatJson['items'])) {
            foreach ($hipChatJson['items'] as $message) {
                $parsedMessage = $this->parseMessage($message);

                if (isset($params['fromUser'])) {
                    if (!is_array($params['fromUser'])) {
                        $params['fromUser'] = array($params['fromUser']);
                    }

                    if (in_array($parsedMessage['from'], $params['fromUser'])) {
                        $returnArray[] = $parsedMessage;
                    }
                } else {
                    $returnArray[] = $parsedMessage;
                }

            }
        }

//        if ($hipChatJson && isset($hipChatJson['messages'])) {
//            $returnArray = array();
//            foreach (array_reverse($hipChatJson['messages']) as $message) {
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
//            }
//
//            return array_slice($returnArray, 0, $params['limit']);
//        } else {
//            return array();
//        }
        return $returnArray;
    }

    private function parseMessage(array $message) {
        $parsedMessage = null;

        $status = '';
        if (isset($message['color'])) {
            $status  = $this->getProjectStatus($message['color']);
        }

        if ((is_array($message['from']))) {
            $userInfo = $this->fetchUserInfo(['userId' => $message['from']['id']]);

            $parsedMessage = [
                'from' => $message['from']['name'],
                'avatar' => sprintf('<img src="%s"/><i class=\"icon-screenshot\"></i>', $message['from']['mention_name']),
                'userInfo' => $userInfo,
                'content' => '<span class="' . $status . '">' . str_replace($this->stripChars, '',$message['message']) . '</span>',
                'projectName' => 'integrator',
                'createdAt' => date('Y-m-d H:i:s'),
            ];
        } else if ((is_string($message['from']))) {
            $parsedMessage = [
                'from' => $message['from'],
                'avatar' => '<img src="https://www.hipchat.com/img/silhouette_125.png"/><i class=\"icon-screenshot\"></i>',
                'content' => '<span class="' . $status . '">' . str_replace($this->stripChars, '',$message['message']) . '</span>',
                'projectName' => 'integrator',
                'createdAt' => date('Y-m-d H:i:s'),
            ];
        }

        return $parsedMessage;
    }

    private function getProjectStatus($color) {
        switch ($color) {
            case 'red':
                return 'failure';
            case 'green':
                return 'success';
            default:
                return '';
        }
    }

    /**
     * Fetch user info
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchUserInfo(array $params = array())
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}
