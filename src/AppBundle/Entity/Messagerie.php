<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
Class Messagerie {
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
    protected $objet;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $message;
    /**
     * @var datetime 
     * 
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}))
     */
    protected $date;

     /**
     * @var integer 
     * 
     * @ORM\Column(type="integer")
     */
    protected $id_sender;
    /**
     * @var integer 
     * 
     * @ORM\Column(type="integer")
     */
    protected $id_recever;
    /**
     * @var boolean 
     * 
     * @ORM\Column(type="boolean")
     */
    protected $vu;

    /*
     * @return int
     */
    function getId() {
        return $this->id;
    }
    /*
     * @return string
     */    

    function getObjet() {
        return $this->objet;
    }
    /*
     * @return string
     */
    function getMessage() {
        return $this->message;
    }
    /*
     * @return int
     */
    function getId_sender() {
        return $this->id_sender;
    }
    /*
     * @return int
     */
    function getId_recever() {
        return $this->id_recever;
    }
    /*
     * @return datetime
     */   
    function getDate() {
        return $this->date;
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
     * @var string 
     * 
     * @return string
     */
    function setObjet($objet) {
        $this->objet = $objet;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setMessage($message) {
        $this->message = $message;
    }
    /**
     * @var datetime
     * 
     * @return datetime
    */
    function setDate($date) {
        $this->date = $date;
    }
    /**
     * @var integer 
     * 
     * @return int
     */

    function setId_sender($id_sender) {
        $this->id_sender = $id_sender;
    }
    /**
     * @var integer 
     * 
     * @return int
     */

    function setId_recever($id_recever) {
        $this->id_recever = $id_recever;
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
