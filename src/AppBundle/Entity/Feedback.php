<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeedbackRepository")
 */
class Feedback
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
     * @ORM\Column(name="feedback", type="string", length=2500)
     */
    private $feedback;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feedback_author")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $fos_user_author;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feedback_to")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     */
    private $fos_user_object;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
    */
    private $createdAt;
    /**
     * @ORM\Column(name="rating", type="integer", nullable=false)
    */
    private $rating;
    /**
     * Get id
     *
     * @return int
     */

    public function __construct() {

        $this->createdAt = new \DateTime("now");

    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set fosUserAuthor
     *
     * @param \AppBundle\Entity\User $fosUserAuthor
     *
     * @return Feedback
     */
    public function setFosUserAuthor(\AppBundle\Entity\User $fosUserAuthor = null)
    {
        $this->fos_user_author = $fosUserAuthor;

        return $this;
    }

    /**
     * Get fosUserAuthor
     *
     * @return \AppBundle\Entity\User
     */
    public function getFosUserAuthor()
    {
        return $this->fos_user_author;
    }

    /**
     * Set fosUserObject
     *
     * @param \AppBundle\Entity\User $fosUserObject
     *
     * @return Feedback
     */
    public function setFosUserObject(\AppBundle\Entity\User $fosUserObject = null)
    {
        $this->fos_user_object = $fosUserObject;

        return $this;
    }

    /**
     * Get fosUserObject
     *
     * @return \AppBundle\Entity\User
     */
    public function getFosUserObject()
    {
        return $this->fos_user_object;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt() {

        return $this->createdAt;

    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Feedback
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Feedback
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
}
