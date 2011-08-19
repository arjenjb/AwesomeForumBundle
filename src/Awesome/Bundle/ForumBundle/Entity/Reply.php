<?php
namespace Awesome\Bundle\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reply")
 */
class Reply
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $posterName;

    /**
     * @ORM\Column(name="date_posted", type="datetime")
     */
    private $datePosted;

    /**
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="replies")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    private $topic;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set posterName
     *
     * @param string $posterName
     */
    public function setPosterName($posterName)
    {
        $this->posterName = $posterName;
    }

    /**
     * Get posterName
     *
     * @return string 
     */
    public function getPosterName()
    {
        return $this->posterName;
    }

    /**
     * Set datePosted
     *
     * @param datetime $datePosted
     */
    public function setDatePosted($datePosted)
    {
        $this->datePosted = $datePosted;
    }

    /**
     * Get datePosted
     *
     * @return datetime 
     */
    public function getDatePosted()
    {
        return $this->datePosted;
    }

    /**
     * Set topic
     *
     * @param Awesome\Bundle\ForumBundle\Entity\Topic $topic
     */
    public function setTopic(\Awesome\Bundle\ForumBundle\Entity\Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get topic
     *
     * @return Awesome\Bundle\ForumBundle\Entity\Topic 
     */
    public function getTopic()
    {
        return $this->topic;
    }
}