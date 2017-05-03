<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TrainingTime
 *
 * @ORM\Table(name="training_time")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainingTimeRepository")
 */
class TrainingTime
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
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="trainingTime")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $training;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TrainingTime
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
     * Set training
     *
     * @param \AppBundle\Entity\Training $training
     *
     * @return TrainingTime
     */
    public function setTraining(\AppBundle\Entity\Training $training = null)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \AppBundle\Entity\Training
     */
    public function getTraining()
    {
        return $this->training;
    }
}
