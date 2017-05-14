<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Astuce
 *
 * @ORM\Table(name="astuce", indexes={@ORM\Index(name="id_mpro", columns={"id_mpro"}), @ORM\Index(name="id_jeux", columns={"id_jeux"})})
 * @ORM\Entity
 */
class Astuce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_astuce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAstuce;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=500, nullable=false)
     */
    private $object;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var \MembrePro
     *
     * @ORM\ManyToOne(targetEntity="MembrePro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mpro", referencedColumnName="id_mpro")
     * })
     */
    private $idMpro;

    /**
     * @var \Jeux
     *
     * @ORM\ManyToOne(targetEntity="Jeux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jeux", referencedColumnName="id_jeux")
     * })
     */
    private $idJeux;

    /**
     * @return int
     */
    public function getIdAstuce()
    {
        return $this->idAstuce;
    }

    /**
     * @param int $idAstuce
     */
    public function setIdAstuce($idAstuce)
    {
        $this->idAstuce = $idAstuce;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param int $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return \MembrePro
     */
    public function getIdMpro()
    {
        return $this->idMpro;
    }

    /**
     * @param \MembrePro $idMpro
     */
    public function setIdMpro($idMpro)
    {
        $this->idMpro = $idMpro;
    }

    /**
     * @return \Jeux
     */
    public function getIdJeux()
    {
        return $this->idJeux;
    }

    /**
     * @param \Jeux $idJeux
     */
    public function setIdJeux($idJeux)
    {
        $this->idJeux = $idJeux;
    }


}

