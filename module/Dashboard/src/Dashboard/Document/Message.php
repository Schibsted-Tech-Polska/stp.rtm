<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Document;

use Doctrine\Common\Persistence\PersistentObject;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Message extends PersistentObject {
    /**
     * Message id
     *
     * @var int
     * @ODM\Id
     */
    protected $id;

    /**
     * Creation datetime
     *
     * @var string
     * @ODM\Date
     */
    protected $createdAt;

    /**
     * Message content
     *
     * @var string
     * @ODM\String
     */
    protected $content;

    /**
     * Project name (dashboard name)
     *
     * @var string
     * @ODM\String
     */
    protected $projectName;

    /**
     * Widget id
     * @var string
     * @ODM\String
     */
    protected $widgetId;

    public function __construct() {
        $this->setCreatedAt(new \Datetime());
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt() {
        return $this->createdAt->format('Y-m-d H:i:s');;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $projectName
     */
    public function setProjectName($projectName) {
        $this->projectName = $projectName;
    }

    /**
     * @return string
     */
    public function getProjectName() {
        return $this->projectName;
    }

    /**
     * @param string $widgetId
     */
    public function setWidgetId($widgetId) {
        $this->widgetId = $widgetId;
    }

    /**
     * @return string
     */
    public function getWidgetId() {
        return $this->widgetId;
    }

    public function toJson() {
        return "{'dupa':'jas'}";
    }
}