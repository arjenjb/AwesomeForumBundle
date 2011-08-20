<?php
namespace Awesome\Bundle\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="topic")
 */
class Topic
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length="100")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
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
     * @ORM\Column(name="date_changed", type="datetime")
     */
    private $dateChanged;

    /**
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="topic")
     * @ORM\OrderBy({"datePosted" = "DESC"})
     */
    private $replies;
    public function __construct()
    {
        $this->replies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return string 
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
     * Set dateChanged
     *
     * @param datetime $dateChanged
     */
    public function setDateChanged($dateChanged)
    {
        $this->dateChanged = $dateChanged;
    }

    /**
     * Get dateChanged
     *
     * @return datetime 
     */
    public function getDateChanged()
    {
        return $this->dateChanged;
    }

    /**
     * Add replies
     *
     * @param Awesome\Bundle\ForumBundle\Entity\Reply $replies
     */
    public function addReplies(\Awesome\Bundle\ForumBundle\Entity\Reply $replies)
    {
        $this->replies[] = $replies;
    }

    /**
     * Get replies
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReplies()
    {
        return $this->replies;
    }
}