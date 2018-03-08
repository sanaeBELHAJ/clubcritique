<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 */
class Categorie
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
     * @ORM\Column(type="string")
     */
    private $titre;


    
     /*
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string 
     * 
     * @return string
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
    }

     /*
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
}

