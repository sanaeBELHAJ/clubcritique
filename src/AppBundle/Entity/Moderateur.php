<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moderateur
 *
 * @ORM\Table(name="moderateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModerateurRepository")
 */
class Moderateur
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
     * @ORM\Column(name="id_membre", type="integer", length=11)
     */
    private $id_membre;

    /**
     * @var int
     *
     * @ORM\Column(name="moderateur", type="integer", length=11)
     */
    private $moderateur;


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
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return Moderateur
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
     * Set moderateur
     *
     * @param integer $moderateur
     *
     * @return Moderateur
     */
    public function setModerateur($moderateur)
    {
        $this->moderateur = $moderateur;

        return $this;
    }

    /**
     * Get moderateur
     *
     * @return int
     */
    public function getModerateur()
    {
        return $this->moderateur;
    }
}

