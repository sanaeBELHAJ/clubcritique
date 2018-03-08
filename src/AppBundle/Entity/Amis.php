<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Amis {
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
    protected $id_membre1;
    /**
     * @var int 
     * 
     * @ORM\Column(type="integer")
     */
    protected $id_membre2;
     
    /**
     * @var boolean 
     * 
     * @ORM\Column(type="boolean")
     */
    protected $accepter = 0;
    
    /**
     * @var boolean 
     * 
     * @ORM\Column(type="boolean")
     */
    protected $vu = 0;


    public function __construct() {
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
    function getId_membre1() {
        return $this->id_membre1;
    }
    /*
     * @return integer
     */
    function getId_membre2() {
        return $this->id_membre2;
    }
    /*
     * @return boolean
     */
    function getAccepter() {
        return $this->accepter;
    }
    
    /*
     * @return boolean
     */
    function getVu() {
        return $this->vu;
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
    function setId_membre1($id_membre1) {
        $this->id_membre1 = $id_membre1;
    }
    /**
     * @var int 
     * 
     * @return int
     */
    function setId_membre2($id_membre2) {
        $this->id_membre2 = $id_membre2;
    }
    /**
     * @var boolean 
     * 
     * @return boolean
     */
    function setAccepter($accepter) {
        $this->accepter = $accepter;
    }
    /**
     * @var boolean 
     * 
     * @return boolean
     */
    function setVu($vu) {
        $this->vu = $vu;
    }
  

}
