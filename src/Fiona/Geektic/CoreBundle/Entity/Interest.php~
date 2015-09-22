<?php

namespace Fiona\Geektic\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fiona\Geektic\CoreBundle\Repository\InterestRepository")
 */
class Interest
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
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;


    /**
     * @ORM\ManyToMany(targetEntity="Geek", inversedBy="interests")
     *
     */
    private $geeks;



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
     * Set label
     *
     * @param string $label
     *
     * @return Interest
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->geeks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add geek
     *
     * @param \Fiona\Geektic\CoreBundle\Entity\Geek $geek
     *
     * @return Interest
     */
    public function addGeek(\Fiona\Geektic\CoreBundle\Entity\Geek $geek)
    {
        $this->geeks[] = $geek;

        return $this;
    }

    /**
     * Remove geek
     *
     * @param \Fiona\Geektic\CoreBundle\Entity\Geek $geek
     */
    public function removeGeek(\Fiona\Geektic\CoreBundle\Entity\Geek $geek)
    {
        $this->geeks->removeElement($geek);
    }

    /**
     * Get geeks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGeeks()
    {
        return $this->geeks;
    }
}
