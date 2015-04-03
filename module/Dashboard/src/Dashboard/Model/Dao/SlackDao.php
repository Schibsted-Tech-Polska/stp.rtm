<?php
namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;

/**
 * Class SlackDao
 * @package Dashboard\Model\Dao
 */
class SlackDao extends AbstractDao
{
    /**
     * Fetch HipChat messages
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchListRecentMessagesForSlackWidget(array $params = [])
    {
        // Get JSON
        $responseJson = $this->request(
            $this->getEndpointUrl(__FUNCTION__),
            $params,
            'json'
        );
        foreach ($responseJson['messages'] as &$message) {
            if (isset($message['user'])) {
                $user = $this->fetchUserInfo(array_replace_recursive($params, ['userId' => $message['user']]));

                if (isset($user['ok']) && $user['ok']) {
                    $message['user'] = $user['user'];
                }
            }

            if (isset($message['icons']['emoji'])) {
                $message['user']['avatar'] = $this->fetchEmoji($params, $message['icons']['emoji']);
            }

            $message = $this->parseResponse($message);
        }

        return $responseJson['messages'];
    }

    private function fetchUserInfo(array $params = [])
    {
        return $this->requestWithCache(
            $this->getEndpointUrl(__FUNCTION__),
            $params,
            'json'
        );
    }

    private function fetchEmoji(array $params = [], $emoji = false)
    {
        $emojiList = $this->requestWithCache(
            $this->getEndpointUrl(__FUNCTION__),
            $params,
            'json'
        );

        $emojiList = $emojiList['emoji'];
        $emoji = str_replace(':', '', $emoji);

        if ($emoji) {
            return isset($emojiList[$emoji]) ? $emojiList[$emoji] : '';
        } else {
            return $emojiList;
        }
    }

    private function parseResponse(array $message)
    {
        $parseDown = $this->getServiceLocator()->get('Parsedown');

        $user = isset($message['user']) ? $message['user'] : [];

        if (isset($message['username'])) {
            $user['name'] = $message['username'];

            unset($message['username']);
        }

        if (isset($message['bot_id'])) {
            $user['id'] = $message['bot_id'];

            unset($message['bot_id']);
        }

        if (isset($message['icons'])) {
            unset($message['icons']);
        }

        if (isset($message['user']['profile']['image_192'])) {
            $user['avatar'] = $message['user']['profile']['image_192'];
        }

        $message['user'] = $user;
        $message['createdAt'] = date('Y-m-d H:i:s', $message['ts']);

        if (isset($message['text'])) {
            $message['text'] = $parseDown->text($message['text']);
        }
        if (isset($message['attachments'])) {
            foreach ($message['attachments'] as &$attachment) {
                $attachment['fallback'] = $parseDown->text($attachment['fallback']);
            }
        }

        return $message;
    }
}
