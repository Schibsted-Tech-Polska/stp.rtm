<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


class IndependentDao extends AbstractDao {
    public function fetchMessagesForMessagesWidget(array $params) {
        $key    = $params['cacheIdentifier'];
        $result = $this->getCacheAdapter()->getItem($key, $success);
        if (!$success) {
            $result = array(
                array(
                    'createdAt' => date('Y-m-d H:i:s'),
                    'content' => 'bla bla bla',
                ),
                array(
                    'createdAt' => date('Y-m-d H:i:s'),
                    'content' => 'bla bla bla 2',
                ),
            );
            $this->getCacheAdapter()->setItem($key, $result);
        }

        return $result;
    }
}