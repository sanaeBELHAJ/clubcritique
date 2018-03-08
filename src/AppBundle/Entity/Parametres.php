<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametres
 *
 * @ORM\Table(name="parametres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametresRepository")
 */
class Parametres
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
     * @ORM\Column(name="nb_max_salon", type="integer", length=11)
     */
    private $nb_max_salon;


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
     * Set nbMaxSalon
     *
     * @param integer $nbMaxSalon
     *
     * @return Parametres
     */
    public function setNbMaxSalon($nbMaxSalon)
    {
        $this->nb_max_salon = $nbMaxSalon;

        return $this;
    }

    /**
     * Get nbMaxSalon
     *
     * @return int
     */
    public function getNbMaxSalon()
    {
        return $this->nb_max_salon;
    }
}

