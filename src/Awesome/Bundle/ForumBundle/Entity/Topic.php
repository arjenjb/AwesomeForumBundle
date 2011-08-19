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
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="topic")
     * @ORM\OrderBy({"datePosted" = "DESC"})
     */
    private $replies;
}
