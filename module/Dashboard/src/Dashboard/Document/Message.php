<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Message extends AbstractDocument {
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
     * URL to person's avatar - optional
     *
     * @var string
     * @ODM\String
     */
    protected $avatarURl;

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
     *
     * @var string
     * @ODM\String
     */
    protected $widgetId;

    /**
     * Message document constructor
     */
    public function __construct() {
        $this->setCreatedAt(new \Datetime());
    }

    /**
     * createdAt datetime setter
     * @param \Datetime $createdAt - date of message creation
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    /**
     * createdAt datetime getter
     * @return string
     */
    public function getCreatedAt() {
        return $this->createdAt->format('Y-m-d H:i:s');;
    }

    /**
     * Message contents
     * @param string $content - message contents
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Message contents getter
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * projectName setter
     * @param string $projectName - project/dashboard name
     */
    public function setProjectName($projectName) {
        $this->projectName = $projectName;
    }

    /**
     * projectName getter
     * @return string
     */
    public function getProjectName() {
        return $this->projectName;
    }

    /**
     * widgetId setter
     * @param string $widgetId - unique to a dashboard widget id
     */
    public function setWidgetId($widgetId) {
        $this->widgetId = $widgetId;
    }

    /**
     * widgetId getter
     * @return string
     */
    public function getWidgetId() {
        return $this->widgetId;
    }

    /**
     * Sets URL to a person's avatar image
     * @param string $avatarURl - full url to the image
     */
    public function setAvatarURl($avatarURl) {
        $this->avatarURl = $avatarURl;
    }

    /**
     * Returns person's avatar image URL
     * @return string
     */
    public function getAvatarURl() {
        return $this->avatarURl;
    }
}