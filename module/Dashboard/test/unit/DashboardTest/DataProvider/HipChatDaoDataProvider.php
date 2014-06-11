<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;


trait HipChatDaoDataProvider {
    /**
     * @return array
     */
    public function fetchListRecentMessagesForMessagesWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/HipChat/fetchListRecentMessagesForMessagesWidgetResponse.txt',
                '$expectedDaoResponse' => array (
                    0 =>
                        array (
                            'projectName' => 'Deploy Bot',
                            'createdAt' => '2010-11-19 16:13:40',
                            'content' => 'This message is sent via the API so the user_id is \'api\'.',
                        ),
                    1 =>
                        array (
                            'projectName' => 'Garret Heaton',
                            'createdAt' => '2010-11-19 15:49:44',
                            'content' => 'This is a file upload',
                        ),
                    2 =>
                        array (
                            'projectName' => 'Garret Heaton',
                            'createdAt' => '2010-11-19 15:48:19',
                            'content' => 'Good morning! This is a regular message.',
                        ),
                ),
            ],
        ];
    }
}
