<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="note", type="integer", length=11)
     */
    private $note;

    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", length=11)
     */
    private $id_article;

    /**
     * @var int
     *
     * @ORM\Column(name="id_membre", type="integer", length=11)
     */
    private $id_membre;


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
     * @param integer $note
     *
     * @return Note
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

    /**
     * Set idArticle
     *
     * @param integer $idArticle
     *
     * @return Note
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

    /**
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return Note
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
}

