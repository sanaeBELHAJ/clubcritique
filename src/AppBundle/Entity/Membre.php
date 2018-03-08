<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
Class Membre {
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
    protected $nom;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $prenom;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $mail;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $description;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $mdp;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $statut;
    /**
     * @var string 
     * 
     * @ORM\Column(type="string")
     */
    protected $picture;

    protected $confirm;
    /*
     * @return int
     */
    function getId() {
        return $this->id;
    }
    /*
     * @return string
     */
    function getNom() {
        return $this->nom;
    }
    /*
     * @return string
     */
    function getPrenom() {
        return $this->prenom;
    }
    /*
     * @return string
     */
    function getMail() {
        return $this->mail;
    }
    /*
     * @return string
     */
    function getDescription() {
        return $this->description;
    }
     /*
     * @return string
     */
    function getMdp() {
        return $this->mdp;
    }

    function getConfirm() {
        return $this->confirm;
    }
     /*
     * @return string
     */
    function getStatut() {
        return $this->statut;
    }
     /*
     * @return 	string
     */
    function getPicture() {
        return $this->picture;
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
    function setNom($nom) {
        $this->nom = $nom;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    /**
     * @var string 
     * 
     * @return string
     */

    function setMail($mail) {
        $this->mail = $mail;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setDescription($description) {
        $this->description = $description;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setMdp($mdp) {
        $this->mdp = $mdp;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setStatut($statut) {
        $this->statut = $statut;
    }
    /**
     * @var string 
     * 
     * @return string
     */
    function setPicture($picture) {
        $this->picture = $picture;
    }

    function setConfirm($confirm) {
        $this->confirm = $confirm;
    }
}
