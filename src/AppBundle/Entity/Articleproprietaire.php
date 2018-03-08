<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Articleproprietaire {
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
    protected $id_membre;
    /**
     * @var int 
     * 
     * @ORM\Column(type="integer")
     */
    protected $id_article;
    


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
    function getId_membre() {
        return $this->id_membre;
    }
    /*
     * @return integer
     */
    function getId_article() {
        return $this->id_article;
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
    function setId_membre($id_membre) {
        $this->id_membre = $id_membre;
    }
    /**
     * @var int 
     * 
     * @return int
     */
    function setId_article($id_article) {
        $this->id_article = $id_article;
    }
}
