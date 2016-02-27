<?php

namespace ComakeitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Symptoms
 *
 * @ORM\Table(name="symptoms")
 * @ORM\Entity(repositoryClass="ComakeitBundle\Repository\SymptomsRepository")
 */
class Symptoms
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
     * @ORM\ManyToOne(targetEntity="Disease", inversedBy="symptoms")
     * @ORM\JoinColumn(name="disease_id", referencedColumnName="id")
     */
    private $disease;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=255)
     */
    private $conditions;


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
     * Set diseaseId
     *
     * @param integer $disease
     *
     * @return Symptoms
     */
    public function setDisease($disease)
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * Get diseaseId
     *
     * @return int
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     *
     * @return Symptoms
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string
     */
    public function getConditions()
    {
        return $this->conditions;
    }
    
    /**
    *
    * @return string
    */
    public function __toString()
    {
      return $this->id;
    }

}

