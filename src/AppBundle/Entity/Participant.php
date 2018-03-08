<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantRepository")
 */
class Participant
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
     * @ORM\Column(name="id_salon", type="integer", length=11)
     */
    private $id_salon;

    /**
     * @var int
     *
     * @ORM\Column(name="id_membre", type="integer", length=11)
     */
    private $id_membre;

    /**
     * @var int
     *
     * @ORM\Column(name="ban", type="integer", length=1)
     */
    private $ban;

    /**
     * @var string
     *
     * @ORM\Column(name="id_membres_who_ban", type="string", length=250)
     */
    private $id_membres_who_ban;
	
	/**
     * @var int
     *
     * @ORM\Column(name="actif", type="integer", length=11)
     */
    private $actif;

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
     * Set idSalon
     *
     * @param integer $idSalon
     *
     * @return Participant
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
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return Participant
     */
    public function setIdMembre($idMembre)
    {
        $this->id_membre = $idMembre;

        return $this;
    }

    /**
     * Get idMembre
     *
     * @return int
     */
    public function getIdMembre()
    {
        return $this->id_membre;
    }

    /**
     * Set ban
     *
     * @param integer $ban
     *
     * @return Participant
     */
    public function setBan($ban)
    {
        $this->ban = $ban;

        return $this;
    }

    /**
     * Get ban
     *
     * @return int
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * Set idMembresWhoBan
     *
     * @param string $idMembresWhoBan
     *
     * @return Participant
     */
    public function setIdMembresWhoBan($idMembresWhoBan)
    {
        $this->id_membres_who_ban = $idMembresWhoBan;

        return $this;
    }

    /**
     * Get idMembresWhoBan
     *
     * @return string
     */
    public function getIdMembresWhoBan()
    {
        return $this->id_membres_who_ban;
    }
    
    /**
     * Set actif
     *
     * @param integer $actif
     *
     * @return Participant
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return int
     */
    public function getActif()
    {
        return $this->actif;
    }
}

