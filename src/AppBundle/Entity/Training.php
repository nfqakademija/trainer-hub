<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainingRepository")
 */
class Training
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="training")
     * @ORM\JoinColumn(name="trainer_id", referencedColumnName="id")
     */
    private $fos_user;
    /**
     * @ORM\OneToMany(targetEntity="Reservations", mappedBy="training", cascade={"persist"})
     */
    private $reservations;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;

    }
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Training
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set price
     *
     * @param string $price
     *
     * @return Training
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Training
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Training
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
     * @return Training
     */
    public function setFosUser(\AppBundle\Entity\User $fosUser = null)
    {
        $this->fos_user = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getFosUser()
    {
        return $this->fos_user;
    }

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\Reservations $reservation
     *
     * @return Training
     */
    public function addReservation(\AppBundle\Entity\Reservations $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \AppBundle\Entity\Reservations $reservation
     */
    public function removeReservation(\AppBundle\Entity\Reservations $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
