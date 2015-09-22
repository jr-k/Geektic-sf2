<?php

namespace Fiona\Geektic\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fiona\Geektic\CoreBundle\Repository\VisitRepository")
 */
class Visit
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateVisit", type="datetime")
     */
    private $dateVisit;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;


    /**
     * @ORM\ManyToOne(targetEntity="Geek", inversedBy="visits")
     *
     */
    private $geek;


    public function __construct() {
        $this->dateVisit = new \DateTime();
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
     * Set dateVisit
     *
     * @param \DateTime $dateVisit
     *
     * @return Visit
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;

        return $this;
    }

    /**
     * Get dateVisit
     *
     * @return \DateTime
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Visit
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set geek
     *
     * @param \Fiona\Geektic\CoreBundle\Entity\Geek $geek
     *
     * @return Visit
     */
    public function setGeek(\Fiona\Geektic\CoreBundle\Entity\Geek $geek = null)
    {
        $this->geek = $geek;

        return $this;
    }

    /**
     * Get geek
     *
     * @return \Fiona\Geektic\CoreBundle\Entity\Geek
     */
    public function getGeek()
    {
        return $this->geek;
    }
}
