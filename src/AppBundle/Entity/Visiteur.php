<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Visiteur {
    //put your code here
    
    
      /**
     * @var integer 
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var int 
     * 
     * @ORM\Column(type="integer")
     */
    protected $nb_visite;
    /**
     * @var int 
     * 
     * @ORM\Column(type="integer")
     */
    protected $id_membre;
     
    /**
     * @var datetime 
     * 
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}))
     */
    protected $date_visite;


    public function __construct() {
        $this->date_visite = new \DateTime(date('Y-m-d H:i:s'));
    }
    /*
     * @return int
     */
    function getId() {
        return $this->id;
    }
    /*
     * @return integer
     */
    function getNb_visite() {
        return $this->nb_visite;
    }
    /*
     * @return integer
     */
    function getId_membre() {
        return $this->id_membre;
    }
    /*
     * @return datetime
     */
    function getDate_visite() {
        return $this->date_visite;
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
     * @var int 
     * 
     * @return int
     */
    function setNb_visite($nb_visite) {
        $this->nb_visite = $nb_visite;
    }
    /**
     * @var int 
     * 
     * @return int
     */
    function setId_membre($id_membre) {
        $this->id_membre = $id_membre;
    }
    /**
     * @var datetime 
     * 
     * @return datetime
     */
    function setDate_visite($date_visite) {
        $this->date_visite = $date_visite;
    }
  

}
