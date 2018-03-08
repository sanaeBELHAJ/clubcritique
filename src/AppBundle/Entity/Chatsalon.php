<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chatsalon
 *
 * @ORM\Table(name="chatsalon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatsalonRepository")
 */
class Chatsalon
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
     * @var string
     *
     * @ORM\Column(name="msg", type="text")
     */
    private $msg;

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
     * Set idSalon
     *
     * @param integer $idSalon
     *
     * @return Chatsalon
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
     * @return Chatsalon
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
     * Set msg
     *
     * @param string $msg
     *
     * @return Chatsalon
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Chatsalon
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

