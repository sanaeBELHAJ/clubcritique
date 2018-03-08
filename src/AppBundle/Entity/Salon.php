<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salon
 *
 * @ORM\Table(name="salon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalonRepository")
 */
class Salon
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
     * @var string
     *
     * @ORM\Column(name="titre_salon", type="string", length=50)
     */
    private $titre_salon;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $date_debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $date_fin;

    /**
     * @var int
     *
     * @ORM\Column(name="valide", type="integer")
     */
    private $valide;

    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", length=11)
     */
    private $id_article;


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
     * Set titreSalon
     *
     * @param string $titreSalon
     *
     * @return Salon
     */
    public function setTitreSalon($titreSalon)
    {
        $this->titre_salon = $titreSalon;

        return $this;
    }

    /**
     * Get titreSalon
     *
     * @return string
     */
    public function getTitreSalon()
    {
        return $this->titre_salon;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Salon
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Salon
     */
    public function setDateDebut($dateDebut)
    {
        $this->date_debut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Salon
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * Set valide
     *
     * @param integer $valide
     *
     * @return Salon
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return int
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set idArticle
     *
     * @param integer $idArticle
     *
     * @return Salon
     */
    public function setIdArticle($idArticle)
    {
        $this->id_article = $idArticle;

        return $this;
    }

    /**
     * Get idArticle
     *
     * @return int
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }
}

