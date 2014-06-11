<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\DiscriminatorMap({"message"="Message", "deploy"="Deploy"})
 */
class Event extends AbstractDocument
{
    const TYPE_MESSAGE = 'message';
    const TYPE_DEPLOY = 'deploy';

    /**
     * Event id
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
     * HTML with person's avatar - optional
     *
     * @var string
     * @ODM\String
     */
    protected $avatar;

    /**
     * Event message content
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
     * Event document constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new \Datetime());
    }

    /**
     * createdAt datetime setter
     * @param \Datetime $createdAt - date of message creation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * createdAt datetime getter
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    /**
     * Event contents
     * @param string $content - message contents
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Event contents getter
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * projectName setter
     * @param string $projectName - project/dashboard name
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;
    }

    /**
     * projectName getter
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * widgetId setter
     * @param string $widgetId - unique to a dashboard widget id
     */
    public function setWidgetId($widgetId)
    {
        $this->widgetId = $widgetId;
    }

    /**
     * widgetId getter
     * @return string
     */
    public function getWidgetId()
    {
        return $this->widgetId;
    }

    /**
     * Sets HTML with a person's avatar image
     * @param string $avatar - full url to the image
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Returns person's avatar image URL
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
