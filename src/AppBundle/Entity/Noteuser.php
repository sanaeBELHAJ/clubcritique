<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="noteuser")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoteRepository")
 */
class Noteuser
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
     * @ORM\Column(name="id_membre_noter", type="integer", length=11)
     */
    private $id_membre_noter;

  
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
     * Set note
     *
     * @param integer $id_membre
     *
     * @return id_membre
     */
    public function setId_membre($id_membre)
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    /**
     * Get id_membre
     *
     * @return int
     */
    public function getId_membre()
    {
        return $this->id_membre;
    }

    /**
     * Set id_membre_noter
     *
     * @param integer $id_membre_noter
     *
     * @return id_membre_noter
     */
    public function setId_membre_noter($id_membre_noter)
    {
        $this->id_membre_noter = $id_membre_noter;

        return $this;
    }

    /**
     * Get id_membre_noter
     *
     * @return int
     */
    public function getId_membre_noter()
    {
        return $this->id_membre_noter;
    }
}

