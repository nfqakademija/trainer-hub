<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true, length=5000)
     */
    private $description;

    /**
     * @var DateTime $birthday
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;
    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="fos_user", cascade={"persist"})
     */
    private $training;
    /**
     * @ORM\OneToMany(targetEntity="Reservations", mappedBy="fos_user", cascade={"persist"})
     */
    private $reservations;
    /**
    * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="avatarName", size="avatarSize")
    *
    * @var File
    * @Assert\File(maxSize = "4024k", mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
    */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $avatarName;

    /**
     * @ORM\Column(type="integer", length=255)
     *
     * @var integer
     */
    private $avatarSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Feedback", mappedBy="fos_user_author", cascade={"persist"})
     */
    private $feedback_author;

    /**
     * @ORM\OneToMany(targetEntity="Feedback", mappedBy="fos_user_object", cascade={"persist"})
     */
    private $feedback_to;


    public function __construct()
    {
        parent::__construct();
        $this->training = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->feedback_author = new ArrayCollection();
        $this->feedback_to = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
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
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add training
     *
     * @param \AppBundle\Entity\Training $training
     *
     * @return User
     */
    public function addTraining(\AppBundle\Entity\Training $training)
    {
        $this->training[] = $training;

        return $this;
    }

    /**
     * Remove training
     *
     * @param \AppBundle\Entity\Training $training
     */
    public function removeTraining(\AppBundle\Entity\Training $training)
    {
        $this->training->removeElement($training);
    }

    /**
     * Get training
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTraining()
    {
        return $this->training;
    }

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\Reservations $reservation
     *
     * @return User
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
    /**
    * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $avatar
    *
    * @return User
    */
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $avatar
     *
     * @return User
     */
    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        if ($avatar) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * @param string $avatarName
     *
     * @return User
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }

    /**
     * @param integer $avatarSize
     *
     * @return User
     */
    public function setAvatarSize($avatarSize)
    {
        $this->avatarsize = $avatarSize;

        return $this;
    }

    /**
     * @return integer|null
     */
    public function getAvatarSize()
    {
        return $this->avatarSize;
    }


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add feedbackAuthor
     *
     * @param \AppBundle\Entity\Feedback $feedbackAuthor
     *
     * @return User
     */
    public function addFeedbackAuthor(\AppBundle\Entity\Feedback $feedbackAuthor)
    {
        $this->feedback_author[] = $feedbackAuthor;

        return $this;
    }

    /**
     * Remove feedbackAuthor
     *
     * @param \AppBundle\Entity\Feedback $feedbackAuthor
     */
    public function removeFeedbackAuthor(\AppBundle\Entity\Feedback $feedbackAuthor)
    {
        $this->feedback_author->removeElement($feedbackAuthor);
    }

    /**
     * Get feedbackAuthor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackAuthor()
    {
        return $this->feedback_author;
    }

    /**
     * Add feedbackTo
     *
     * @param \AppBundle\Entity\Feedback $feedbackTo
     *
     * @return User
     */
    public function addFeedbackTo(\AppBundle\Entity\Feedback $feedbackTo)
    {
        $this->feedback_to[] = $feedbackTo;

        return $this;
    }

    /**
     * Remove feedbackTo
     *
     * @param \AppBundle\Entity\Feedback $feedbackTo
     */
    public function removeFeedbackTo(\AppBundle\Entity\Feedback $feedbackTo)
    {
        $this->feedback_to->removeElement($feedbackTo);
    }

    /**
     * Get feedbackTo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackTo()
    {
        return $this->feedback_to;
    }
}
