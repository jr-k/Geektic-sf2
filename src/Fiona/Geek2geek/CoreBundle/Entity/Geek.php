<?php

namespace Fiona\Geek2geek\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geek
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fiona\Geek2geek\CoreBundle\Repository\GeekRepository")
 */
class Geek
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesign", type="datetime")
     */
    private $datesign;


    /**
     * @ORM\ManyToMany(targetEntity="Interest", mappedBy="geeks")
     *
     */
    private $interests;


    /**
     * @ORM\OneToMany(targetEntity="Visit", mappedBy="geek")
     *
     */
    private $visits;



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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Geek
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Geek
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Geek
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Geek
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set datesign
     *
     * @param \DateTime $datesign
     *
     * @return Geek
     */
    public function setDatesign($datesign)
    {
        $this->datesign = $datesign;

        return $this;
    }

    /**
     * Get datesign
     *
     * @return \DateTime
     */
    public function getDatesign()
    {
        return $this->datesign;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add interest
     *
     * @param \Fiona\Geek2geek\CoreBundle\Entity\Interest $interest
     *
     * @return Geek
     */
    public function addInterest(\Fiona\Geek2geek\CoreBundle\Entity\Interest $interest)
    {
        $this->interests[] = $interest;

        return $this;
    }

    /**
     * Remove interest
     *
     * @param \Fiona\Geek2geek\CoreBundle\Entity\Interest $interest
     */
    public function removeInterest(\Fiona\Geek2geek\CoreBundle\Entity\Interest $interest)
    {
        $this->interests->removeElement($interest);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Add visit
     *
     * @param \Fiona\Geek2geek\CoreBundle\Entity\Visit $visit
     *
     * @return Geek
     */
    public function addVisit(\Fiona\Geek2geek\CoreBundle\Entity\Visit $visit)
    {
        $this->visits[] = $visit;

        return $this;
    }

    /**
     * Remove visit
     *
     * @param \Fiona\Geek2geek\CoreBundle\Entity\Visit $visit
     */
    public function removeVisit(\Fiona\Geek2geek\CoreBundle\Entity\Visit $visit)
    {
        $this->visits->removeElement($visit);
    }

    /**
     * Get visits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisits()
    {
        return $this->visits;
    }

    public function hasInterest($id) {
        foreach($this->getInterests() as $interest) {
            if ($interest->getId() == $id) {
                return true;
            }
        }

        return false;
    }
}
