<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationsRepository")
 */
class Reservations
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
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reservations")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $fosUser;
    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="reservations")
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
     * @return Reservations
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
     * Set fosUser
     *
     * @param \AppBundle\Entity\User $fosUser
     *
     * @return Reservations
     */
    public function setFosUser(\AppBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Set training
     *
     * @param \AppBundle\Entity\Training $training
     *
     * @return Reservations
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
