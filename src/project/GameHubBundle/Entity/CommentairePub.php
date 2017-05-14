<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentairePub
 *
 * @ORM\Table(name="commentaire_pub", indexes={@ORM\Index(name="id_publication", columns={"id_publication"}), @ORM\Index(name="id_comm", columns={"id_comm"}), @ORM\Index(name="id_membre", columns={"id_membre"}), @ORM\Index(name="id_mpro", columns={"id_mpro"})})
 * @ORM\Entity
 */
class CommentairePub
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_comm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idComm;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=500, nullable=false)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="date", nullable=false)
     */
    private $dateAjout;

    /**
     * @var \Publication
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication", referencedColumnName="id_pub")
     * })
     */
    private $idPublication;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id_membre")
     * })
     */
    private $idMembre;

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
     * @return int
     */
    public function getIdComm()
    {
        return $this->idComm;
    }

    /**
     * @param int $idComm
     */
    public function setIdComm($idComm)
    {
        $this->idComm = $idComm;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return \Publication
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * @param \Publication $idPublication
     */
    public function setIdPublication($idPublication)
    {
        $this->idPublication = $idPublication;
    }

    /**
     * @return \Membre
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * @param \Membre $idMembre
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;
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


}

