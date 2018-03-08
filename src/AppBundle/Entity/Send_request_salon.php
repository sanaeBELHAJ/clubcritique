<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Send_request_salon
 *
 * @ORM\Table(name="send_request_salon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Send_request_salonRepository")
 */
class Send_request_salon
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
     * @ORM\Column(name="id_salon", type="integer", length=11)
     */
    private $id_salon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * @return Send_request_salon
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
     * Set idSalon
     *
     * @param integer $idSalon
     *
     * @return Send_request_salon
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Send_request_salon
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

