<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=250)
     */
    protected $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="string", length=250)
     */
    protected $resume;
    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=250)
     */
    protected $auteur;
    /**
     * @var date
     *
     * @ORM\Column(name="date_sortie", type="date")
     */
    protected $date_sortie;

    /**
     * @var string
     *
     * @ORM\Column(name="urlVendeur", type="string", length=250)
     */
    protected $urlVendeur;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", length=1)
     */
    protected $statut;

    /**
     * @var int
     *
     * @ORM\Column(name="laune", type="integer", length=1)
     */
    protected $laune;

    /**
     * @var int
     *
     * @ORM\Column(name="idCategorie", type="integer", length=11)
     */
    protected $idCategorie;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=11)
     */
    protected $image;


    /**
     * Get id
     *
     * @return int
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
     function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Article
     */
     function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
     function getResume()
    {
        return $this->resume;
    }

    /**
     * Set urlVendeur
     *
     * @param string $urlVendeur
     *
     * @return Article
     */
     function setUrlVendeur($urlVendeur)
    {
        $this->urlVendeur = $urlVendeur;

        return $this;
    }

    /**
     * Get urlVendeur
     *
     * @return string
     */
     function getUrlVendeur()
    {
        return $this->urlVendeur;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Article
     */
    function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set laune
     *
     * @param integer $laune
     *
     * @return Article
     */
    function setLaune($laune)
    {
        $this->laune = $laune;

        return $this;
    }

    /**
     * Get laune
     *
     * @return int
     */
    function getLaune()
    {
        return $this->laune;
    }
    /**
     * Get auteur
     *
     * @return string
     */   
    function getAuteur() {
        return $this->auteur;
    }
    /**
     * Get date_sortie
     *
     * @return date
     */
    function getDate_sortie() {
        return $this->date_sortie;
    }
    /**
     * Get image
     *
     * @return string
     */
    function getImage() {
        return $this->image;
    }
      /**
     * Get idCategorie
     *
     * @return int
     */
     function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set idCategorie
     *
     * @param integer $idCategorie
     *
     * @return Article
     */
     function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
    /**
     * Set auteur
     *
     * @param varchar $auteur
     *
     * @return auteur
     */

    function setAuteur($auteur) {
        $this->auteur = $auteur;
    }
    /**
     * Set date_sortie
     *
     * @param date $date_sortie
     *
     * @return date
     */
    function setDate_sortie($date_sortie) {
        $this->date_sortie = $date_sortie;
    }
    /**
     * Set image
     *
     * @param string $image
     *
     * @return image
     */   
     function setImage($image) {
        $this->image = $image;
    }

   
}

