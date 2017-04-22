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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feedback")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $fos_user_author;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feedback")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     */
    private $fos_user_object;

    /**
     * Get id
     *
     * @return int
     */
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
     * @param \AppBundle\Entity\fos_user $fosUserAuthor
     *
     * @return Feedback
     */
    public function setFosUserAuthor(\AppBundle\Entity\fos_user $fosUserAuthor = null)
    {
        $this->fos_user_author = $fosUserAuthor;

        return $this;
    }

    /**
     * Get fosUserAuthor
     *
     * @return \AppBundle\Entity\fos_user
     */
    public function getFosUserAuthor()
    {
        return $this->fos_user_author;
    }

    /**
     * Set fosUserObject
     *
     * @param \AppBundle\Entity\fos_user $fosUserObject
     *
     * @return Feedback
     */
    public function setFosUserObject(\AppBundle\Entity\fos_user $fosUserObject = null)
    {
        $this->fos_user_object = $fosUserObject;

        return $this;
    }

    /**
     * Get fosUserObject
     *
     * @return \AppBundle\Entity\fos_user
     */
    public function getFosUserObject()
    {
        return $this->fos_user_object;
    }
}
