<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestations
 *
 * @ORM\Table(name="prestations", indexes={@ORM\Index(name="fk_Prestations_Saisons1", columns={"idSaison"})})
 * @ORM\Entity
 */
class Prestations
{
    /**
     * @var string
     *
     * @ORM\Column(name="idPrestation", type="string", length=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprestation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prestation", type="string", length=50, nullable=false)
     */
    private $nomPrestation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="time", nullable=false)
     */
    private $duree;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif_client", type="float", precision=10, scale=0, nullable=false)
     */
    private $tarifClient;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif_employe", type="float", precision=10, scale=0, nullable=false)
     */
    private $tarifEmploye;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=500, nullable=true)
     */
    private $note;

    /**
     * @var \AppBundle\Entity\Saisons
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Saisons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSaison", referencedColumnName="idSaison")
     * })
     */
    private $idsaison;



    /**
     * Get idprestation.
     *
     * @return string
     */
    public function getIdprestation()
    {
        return $this->idprestation;
    }

    /**
     * Set nomPrestation.
     *
     * @param string $nomPrestation
     *
     * @return Prestations
     */
    public function setNomPrestation($nomPrestation)
    {
        $this->nomPrestation = $nomPrestation;

        return $this;
    }

    /**
     * Get nomPrestation.
     *
     * @return string
     */
    public function getNomPrestation()
    {
        return $this->nomPrestation;
    }

    /**
     * Set duree.
     *
     * @param \DateTime $duree
     *
     * @return Prestations
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set tarifClient.
     *
     * @param float $tarifClient
     *
     * @return Prestations
     */
    public function setTarifClient($tarifClient)
    {
        $this->tarifClient = $tarifClient;

        return $this;
    }

    /**
     * Get tarifClient.
     *
     * @return float
     */
    public function getTarifClient()
    {
        return $this->tarifClient;
    }

    /**
     * Set tarifEmploye.
     *
     * @param float $tarifEmploye
     *
     * @return Prestations
     */
    public function setTarifEmploye($tarifEmploye)
    {
        $this->tarifEmploye = $tarifEmploye;

        return $this;
    }

    /**
     * Get tarifEmploye.
     *
     * @return float
     */
    public function getTarifEmploye()
    {
        return $this->tarifEmploye;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return Prestations
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set idsaison.
     *
     * @param \AppBundle\Entity\Saisons|null $idsaison
     *
     * @return Prestations
     */
    public function setIdsaison(\AppBundle\Entity\Saisons $idsaison = null)
    {
        $this->idsaison = $idsaison;

        return $this;
    }

    /**
     * Get idsaison.
     *
     * @return \AppBundle\Entity\Saisons|null
     */
    public function getIdsaison()
    {
        return $this->idsaison;
    }
}
