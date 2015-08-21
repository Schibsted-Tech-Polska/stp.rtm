<?php
/**
 * @author pdziok
 */
namespace Dashboard\EventListener\AnalyzerViolation;

use Dashboard\Model\Analyzer\AnalyzerResult;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ServerErrorResponseException;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

class PushNotifier implements ListenerAggregateInterface
{
    private $privateKey;
    private $publicKey;
    private $apiUrl;
    /** @var  CallbackHandler */
    private $handler;

    /**
     * PushNotifier constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->privateKey = $config['privateKey'];
        $this->publicKey = $config['publicKey'];
        $this->apiUrl = $config['apiUrl'];
    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->handler = $events->getSharedManager()->attach(
            'Dashboard\Model\AnalyzerRunner',
            'analyzer.violation',
            [$this, 'handle']
        );
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        $events->getSharedManager()->detach('Dashboard\Model\AnalyzerRunner', $this->handler);
    }

    public function handle(Event $event)
    {
        $params = $event->getParams();
        /** @var AnalyzerResult $analyzeResult */
        list($analyzeResult, $config) = $params;

        $platforms = $config['analyze']['notify']['platforms'];
        $subscriptionIds = $config['analyze']['notify']['subscriptionIds'];
        $message = $this->generateMessage($analyzeResult, $subscriptionIds, $platforms);
        $request = $this->prepareRequest($message);

        try {
            $request->send();
        } catch (ServerErrorResponseException $e) {
            //shut up
        }
    }

    private function generateSignature($method, $endpoint, $timestamp)
    {
        $hashSource = implode('|', [$method, $this->apiUrl . $endpoint, $this->publicKey, $timestamp]);

        return hash_hmac('sha256', $hashSource, $this->privateKey);
    }

    /**
     * @param $authSignature
     * @param $timestamp
     * @return array
     */
    private function generateHeaders($authSignature, $timestamp)
    {
        $headers = [
            "X-VgnoApiAuth-PublicKey" => $this->publicKey,
            "X-VgnoApiAuth-Authenticate-Signature" => $authSignature,
            "X-VgnoApiAuth-Authenticate-Timestamp" => $timestamp,
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "User-Agent" => "STP RTM",
        ];

        return $headers;
    }

    /**
     * @param AnalyzerResult $analyzerResult
     * @param                $subscriptionIds
     * @param                $platforms
     * @return array
     */
    private function generateMessage(AnalyzerResult $analyzerResult, $subscriptionIds, $platforms)
    {
        $messageTitle = $this->generateMessageTitle($analyzerResult);
        $messagePayload = $this->generateMessagePayload($analyzerResult);

        $message = [
            "date" => time(),
            "sender" => "STP RTM",
            "title" => $messageTitle,
            "description" => '',
            "sound" => "",
            "image" => "",
            "incrementor" => 0,
            "payload" => $messagePayload,
            "subscriptions" => $subscriptionIds,
            "platforms" => $platforms,
        ];

        return $message;
    }

    /**
     * @param $analyzeResult
     * @return string
     */
    private function generateMessagePayload(AnalyzerResult $analyzeResult)
    {
        $messagePayload = json_encode([
            'widgetId' => $analyzeResult->getWidgetId(),
            'app' => $analyzeResult->getApplication(),
            'status' => $analyzeResult->getStatus(),
        ]);

        return $messagePayload;
    }

    /**
     * @param $analyzeResult
     * @return string
     */
    private function generateMessageTitle(AnalyzerResult $analyzeResult)
    {
        $messageTitle = sprintf('%s: %s', $analyzeResult->getApplication(), $analyzeResult->getMessage());

        return $messageTitle;
    }

    /**
     * @return string
     */
    private function generateTimestamp()
    {
        $timestamp = (new \DateTime())->setTimezone(new \DateTimeZone('Z'))->format('Y-m-d\TH:i:s\Z');

        return $timestamp;
    }

    /**
     * @param $message
     * @return \Guzzle\Http\Message\EntityEnclosingRequestInterface|\Guzzle\Http\Message\RequestInterface
     */
    private function prepareRequest($message)
    {
        $timestamp = $this->generateTimestamp();

        $endpoint = 'message';
        $authSignature = $this->generateSignature('POST', $endpoint, $timestamp);
        $headers = $this->generateHeaders($authSignature, $timestamp);

        $httpClient = new Client($this->apiUrl);
        $request = $httpClient->post($endpoint, $headers, json_encode($message));

        return $request;
    }
}
