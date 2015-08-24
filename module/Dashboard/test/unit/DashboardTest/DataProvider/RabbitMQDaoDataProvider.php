<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\DataProvider;

trait RabbitMQDaoDataProvider
{
    /**
     * @return array
     */
    public function fetchQueuesForRabbitMQWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../Mock/Dao/RabbitMQ/fetchQueuesForRabbitMQWidgetResponse.txt',
                '$expectedDaoResponse' => array (
                    'integrator:clean:adobe-campaign:queue' =>
                        array (
                            'memory' => 10771136,
                            'message_stats' =>
                                array (
                                    'ack' => 53,
                                    'ack_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'deliver' => 57,
                                        'deliver_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'deliver_get' => 57,
                                        'deliver_get_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'publish' => 7121,
                                        'publish_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                ),
                                'messages' => 7067,
                                'messages_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_ready' => 7067,
                                'messages_ready_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_unacknowledged' => 0,
                                'messages_unacknowledged_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'idle_since' => '2014-09-25 11:46:42',
                                'policy' => '',
                                'exclusive_consumer_tag' => '',
                                'consumers' => 0,
                                'backing_queue_status' =>
                                array (
                                    'q1' => 0,
                                    'q2' => 0,
                                    'delta' =>
                                        array (
                                            0 => 'delta',
                                            1 => 'undefined',
                                            2 => 0,
                                            3 => 'undefined',
                                        ),
                                        'q3' => 0,
                                        'q4' => 7067,
                                        'len' => 7067,
                                        'pending_acks' => 0,
                                        'target_ram_count' => 'infinity',
                                        'ram_msg_count' => 7067,
                                        'ram_ack_count' => 0,
                                        'next_seq_id' => 7121,
                                        'persistent_count' => 0,
                                        'avg_ingress_rate' => 0.057795318566766556,
                                        'avg_egress_rate' => 0,
                                        'avg_ack_ingress_rate' => 0,
                                        'avg_ack_egress_rate' => 0,
                                ),
                                'status' => 'running',
                                'name' => 'integrator:clean:adobe-campaign:queue',
                                'vhost' => 'integrator',
                                'durable' => true,
                                'auto_delete' => false,
                                'arguments' =>
                                array (
                                ),
                                'node' => 'rabbit@vg-dev-01',
                        ),
                        'integrator:clean:hadoop:queue' =>
                        array (
                            'memory' => 100305384,
                            'message_stats' =>
                                array (
                                    'ack' => 4810,
                                    'ack_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'deliver' => 4821,
                                        'deliver_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'deliver_get' => 4821,
                                        'deliver_get_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'publish' => 87549,
                                        'publish_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'redeliver' => 9,
                                        'redeliver_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                ),
                                'messages' => 82739,
                                'messages_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_ready' => 82739,
                                'messages_ready_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_unacknowledged' => 0,
                                'messages_unacknowledged_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'idle_since' => '2014-09-25 11:46:45',
                                'policy' => '',
                                'exclusive_consumer_tag' => '',
                                'consumers' => 0,
                                'backing_queue_status' =>
                                array (
                                    'q1' => 0,
                                    'q2' => 0,
                                    'delta' =>
                                        array (
                                            0 => 'delta',
                                            1 => 'undefined',
                                            2 => 0,
                                            3 => 'undefined',
                                        ),
                                        'q3' => 0,
                                        'q4' => 82739,
                                        'len' => 82739,
                                        'pending_acks' => 0,
                                        'target_ram_count' => 'infinity',
                                        'ram_msg_count' => 82739,
                                        'ram_ack_count' => 0,
                                        'next_seq_id' => 87549,
                                        'persistent_count' => 0,
                                        'avg_ingress_rate' => 70.45393089691855,
                                        'avg_egress_rate' => 0,
                                        'avg_ack_ingress_rate' => 0,
                                        'avg_ack_egress_rate' => 0,
                                ),
                                'status' => 'running',
                                'name' => 'integrator:clean:hadoop:queue',
                                'vhost' => 'integrator',
                                'durable' => true,
                                'auto_delete' => false,
                                'arguments' =>
                                array (
                                ),
                                'node' => 'rabbit@vg-dev-01',
                        ),
                        'integrator:clean:mysql:queue' =>
                        array (
                            'memory' => 601184,
                            'message_stats' =>
                                array (
                                    'publish' => 572,
                                    'publish_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                ),
                                'messages' => 572,
                                'messages_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_ready' => 572,
                                'messages_ready_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'messages_unacknowledged' => 0,
                                'messages_unacknowledged_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'idle_since' => '2014-09-25 11:46:41',
                                'policy' => '',
                                'exclusive_consumer_tag' => '',
                                'consumers' => 0,
                                'backing_queue_status' =>
                                array (
                                    'q1' => 0,
                                    'q2' => 0,
                                    'delta' =>
                                        array (
                                            0 => 'delta',
                                            1 => 'undefined',
                                            2 => 0,
                                            3 => 'undefined',
                                        ),
                                        'q3' => 0,
                                        'q4' => 572,
                                        'len' => 572,
                                        'pending_acks' => 0,
                                        'target_ram_count' => 'infinity',
                                        'ram_msg_count' => 572,
                                        'ram_ack_count' => 0,
                                        'next_seq_id' => 572,
                                        'persistent_count' => 0,
                                        'avg_ingress_rate' => 0,
                                        'avg_egress_rate' => 0,
                                        'avg_ack_ingress_rate' => 0,
                                        'avg_ack_egress_rate' => 0,
                                ),
                                'status' => 'running',
                                'name' => 'integrator:clean:mysql:queue',
                                'vhost' => 'integrator',
                                'durable' => true,
                                'auto_delete' => false,
                                'arguments' =>
                                array (
                                ),
                                'node' => 'rabbit@vg-dev-01',
                        ),
                        'integrator:raw:hadoop:queue' =>
                        array (
                            'message_stats' =>
                                array (
                                    'ack' => 7091,
                                    'ack_details' =>
                                        array (
                                            'rate' => 55,
                                        ),
                                        'deliver' => 7113,
                                        'deliver_details' =>
                                        array (
                                            'rate' => 55,
                                        ),
                                        'deliver_get' => 7113,
                                        'deliver_get_details' =>
                                        array (
                                            'rate' => 55,
                                        ),
                                        'publish' => 87549,
                                        'publish_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                        'redeliver' => 21,
                                        'redeliver_details' =>
                                        array (
                                            'rate' => 0,
                                        ),
                                ),
                                'messages' => 80438,
                                'messages_details' =>
                                array (
                                    'rate' => -55.399999999999999,
                                ),
                                'messages_ready' => 80435,
                                'messages_ready_details' =>
                                array (
                                    'rate' => -55.399999999999999,
                                ),
                                'messages_unacknowledged' => 3,
                                'messages_unacknowledged_details' =>
                                array (
                                    'rate' => 0,
                                ),
                                'policy' => '',
                                'exclusive_consumer_tag' => '',
                                'consumers' => 1,
                                'memory' => 80244792,
                                'backing_queue_status' =>
                                array (
                                    'q1' => 0,
                                    'q2' => 0,
                                    'delta' =>
                                        array (
                                            0 => 'delta',
                                            1 => 'undefined',
                                            2 => 0,
                                            3 => 'undefined',
                                        ),
                                        'q3' => 0,
                                        'q4' => 80435,
                                        'len' => 80435,
                                        'pending_acks' => 3,
                                        'target_ram_count' => 'infinity',
                                        'ram_msg_count' => 80435,
                                        'ram_ack_count' => 3,
                                        'next_seq_id' => 87549,
                                        'persistent_count' => 0,
                                        'avg_ingress_rate' => 0,
                                        'avg_egress_rate' => 57.858956168758866,
                                        'avg_ack_ingress_rate' => 57.858956168758866,
                                        'avg_ack_egress_rate' => 57.858956168758866,
                                ),
                                'status' => 'running',
                                'name' => 'integrator:raw:hadoop:queue',
                                'vhost' => 'integrator',
                                'durable' => true,
                                'auto_delete' => false,
                                'arguments' =>
                                array (
                                ),
                                'node' => 'rabbit@vg-dev-01',
                        ),
                    ),
            ],
        ];
    }
}
