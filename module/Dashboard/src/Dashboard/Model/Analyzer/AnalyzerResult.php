<?php
/**
 * @author pdziok
 */
namespace Dashboard\Model\Analyzer;

class AnalyzerResult
{
    const OK = 'ok';
    const CAUTION = 'caution';
    const CRITICAL = 'critical';

    /** @var string */
    private $widgetId;
    /** @var string */
    private $status;
    /** @var string */
    private $metric;
    /** @var string */
    private $message;
    /** @var string */
    private $application;

    /**
     * AnalyzerResult constructor.
     *
     * @param $widgetId
     * @param $status
     * @param $metric
     * @param $message
     * @param $application
     */
    public function __construct($widgetId, $status, $metric, $message, $application)
    {
        $this->widgetId = $widgetId;
        $this->status = $status;
        $this->metric = $metric;
        $this->message = $message;
        $this->application = $application;
    }

    /**
     * @return string
     */
    public function getWidgetId()
    {
        return $this->widgetId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return bool
     */
    public function isOk()
    {
        return $this->getStatus() == self::OK;
    }

    /**
     * @return bool
     */
    public function isCaution()
    {
        return $this->getStatus() == self::CAUTION;
    }

    /**
     * @return bool
     */
    public function isCritical()
    {
        return $this->getStatus() == self::CRITICAL;
    }

    public function toArray()
    {
        return [
            'widgetId' => $this->getWidgetId(),
            'status' => $this->getStatus(),
            'metric' => $this->getMetric(),
            'message' => $this->getMessage(),
            'application' => $this->getApplication(),
        ];
    }
}
