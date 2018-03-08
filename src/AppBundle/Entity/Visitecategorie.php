<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Visitecategorie {
    //put your code here
    
     /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_visite", type="integer", length=11)
     */
    private $nb_visite;

    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", length=11)
     */
    private $id_categorie;
    
    
     /*
     * @return int
     */
    function getId() {
        return $this->id;
    }
     /*
     * @return int
     */
    function getNb_visite() {
        return $this->nb_visite;
    }
     /*
     * @return int
     */
    function getId_categorie() {
        return $this->id_categorie;
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
    function setId_categorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    
}
