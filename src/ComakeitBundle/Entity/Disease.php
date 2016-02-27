<?php

namespace ComakeitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Disease
 *
 * @ORM\Table(name="disease")
 * @ORM\Entity(repositoryClass="ComakeitBundle\Repository\DiseaseRepository")
 */
class Disease
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
     * @ORM\OneToMany(targetEntity="Symptoms", mappedBy="disease", cascade={"remove"})
     */
    private $symptoms;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * 
     */
    public function __construct() {
        $this->symptoms = new ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     *
     * @return Disease
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
     * 
     * @return ComakeitBundle\Entity\Symptoms
     */
    public function getSymptoms()
    {
      return $this->symptoms;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString() 
    {
      return $this->getName();
    }

}

