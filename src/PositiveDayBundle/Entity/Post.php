<?php

namespace PositiveDayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="PositiveDayBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="PositiveDayBundle\Entity\User", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="PositiveDayBundle\Entity\Comment", mappedBy="post")
     */
    private $coms;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Post
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set user
     *
     * @param \PositiveDayBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\PositiveDayBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PositiveDayBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add coms
     *
     * @param \PositiveDayBundle\Entity\Comment $coms
     * @return Post
     */
    public function addCom(\PositiveDayBundle\Entity\Comment $coms)
    {
        $this->coms[] = $coms;

        return $this;
    }

    /**
     * Remove coms
     *
     * @param \PositiveDayBundle\Entity\Comment $coms
     */
    public function removeCom(\PositiveDayBundle\Entity\Comment $coms)
    {
        $this->coms->removeElement($coms);
    }

    /**
     * Get coms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComs()
    {
        return $this->coms;
    }
}
