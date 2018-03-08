<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
Class Concept {
    /**
     * @var integer 
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $concept;
    
    /*
     * @return int
     */
    function getId() {
        return $this->id;
    }
     /*
     * @return string
     */
    function getConcept() {
        return $this->concept;
    }
    /**
     * @var int 
     * 
     * @return int
     */
    function setId($id) {
        $this->id = $id;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setConcept($concept) {
        $this->concept = $concept;
    }
   
}
