<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inviter_au_salon
 *
 * @ORM\Table(name="inviter_au_salon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Inviter_au_salonRepository")
 */
class Inviter_au_salon
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
     * @var int
     *
     * @ORM\Column(name="id_membre_envoie", type="integer", length=11)
     */
    private $id_membre_envoie;

    /**
     * @var int
     *
     * @ORM\Column(name="id_membre_recoit", type="integer", length=11)
     */
    private $id_membre_recoit;

    /**
     * @var int
     *
     * @ORM\Column(name="id_salon", type="integer", length=11)
     */
    private $id_salon;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", length=11)
     */
    private $statut;


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
     * Set idMembreEnvoie
     *
     * @param integer $idMembreEnvoie
     *
     * @return Inviter_au_salon
     */
    public function setIdMembreEnvoie($idMembreEnvoie)
    {
        $this->id_membre_envoie = $idMembreEnvoie;

        return $this;
    }

    /**
     * Get idMembreEnvoie
     *
     * @return int
     */
    public function getIdMembreEnvoie()
    {
        return $this->id_membre_envoie;
    }

    /**
     * Set idMembreRecoit
     *
     * @param integer $idMembreRecoit
     *
     * @return Inviter_au_salon
     */
    public function setIdMembreRecoit($idMembreRecoit)
    {
        $this->id_membre_recoit = $idMembreRecoit;

        return $this;
    }

    /**
     * Get idMembreRecoit
     *
     * @return int
     */
    public function getIdMembreRecoit()
    {
        return $this->id_membre_recoit;
    }

    /**
     * Set idSalon
     *
     * @param integer $idSalon
     *
     * @return Inviter_au_salon
     */
    public function setIdSalon($idSalon)
    {
        $this->id_salon = $idSalon;

        return $this;
    }

    /**
     * Get idSalon
     *
     * @return int
     */
    public function getIdSalon()
    {
        return $this->id_salon;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Inviter_au_salon
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }
}

