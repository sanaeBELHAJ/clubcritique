<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bon_mauvais_membre
 *
 * @ORM\Table(name="bon_mauvais_membre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\bon_mauvais_membreRepository")
 */
class bon_mauvais_membre
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
     * @ORM\Column(name="id_membre_recoit", type="integer", length=11)
     */
    private $id_membre_recoit;

    /**
     * @var int
     *
     * @ORM\Column(name="id_membre_donne", type="integer", length=11)
     */
    private $id_membre_donne;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", length=11)
     */
    private $note;


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
     * Set idMembreRecoit
     *
     * @param integer $idMembreRecoit
     *
     * @return bon_mauvais_membre
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
     * Set idMembreDonne
     *
     * @param integer $idMembreDonne
     *
     * @return bon_mauvais_membre
     */
    public function setIdMembreDonne($idMembreDonne)
    {
        $this->id_membre_donne = $idMembreDonne;

        return $this;
    }

    /**
     * Get idMembreDonne
     *
     * @return int
     */
    public function getIdMembreDonne()
    {
        return $this->id_membre_donne;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return bon_mauvais_membre
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }
}

