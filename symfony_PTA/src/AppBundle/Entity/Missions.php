<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Missions
 *
 * @ORM\Table(name="missions", indexes={@ORM\Index(name="fk_Missions_Prestations1", columns={"idPrestation"})})
 * @ORM\Entity
 */
class Missions
{
    /**
     * @var string
     *
     * @ORM\Column(name="idMission", type="string", length=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmission;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=45, nullable=false)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="meet", type="string", length=45, nullable=false)
     */
    private $meet;

    /**
     * @var string
     *
     * @ORM\Column(name="coach", type="string", length=50, nullable=false)
     */
    private $coach;

    /**
     * @var string
     *
     * @ORM\Column(name="idTour", type="string", length=25, nullable=false)
     */
    private $idtour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_tour", type="string", length=45, nullable=true)
     */
    private $nomTour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pax", type="string", length=6, nullable=true)
     */
    private $pax;

    /**
     * @var string
     *
     * @ORM\Column(name="hotel", type="string", length=45, nullable=false)
     */
    private $hotel;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=20, nullable=false)
     */
    private $service;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_supp_client", type="time", nullable=true)
     */
    private $heureSuppClient;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_supp_employe", type="time", nullable=true)
     */
    private $heureSuppEmploye;

    /**
     * @var float|null
     *
     * @ORM\Column(name="no_tc_client", type="float", precision=10, scale=0, nullable=true)
     */
    private $noTcClient;

    /**
     * @var float|null
     *
     * @ORM\Column(name="no_tc_employe", type="float", precision=10, scale=0, nullable=true)
     */
    private $noTcEmploye;

    /**
     * @var float|null
     *
     * @ORM\Column(name="debours", type="float", precision=10, scale=0, nullable=true)
     */
    private $debours;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=500, nullable=true)
     */
    private $note;

    /**
     * @var \AppBundle\Entity\Prestations
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Prestations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPrestation", referencedColumnName="idPrestation")
     * })
     */
    private $idprestation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Personnes", inversedBy="idmission")
     * @ORM\JoinTable(name="roles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idMission", referencedColumnName="idMission")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     *   }
     * )
     */
    private $idpersonne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idpersonne = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idmission.
     *
     * @return string
     */
    public function getIdmission()
    {
        return $this->idmission;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Missions
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heure.
     *
     * @param \DateTime $heure
     *
     * @return Missions
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure.
     *
     * @return \DateTime
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set client.
     *
     * @param string $client
     *
     * @return Missions
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client.
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set meet.
     *
     * @param string $meet
     *
     * @return Missions
     */
    public function setMeet($meet)
    {
        $this->meet = $meet;

        return $this;
    }

    /**
     * Get meet.
     *
     * @return string
     */
    public function getMeet()
    {
        return $this->meet;
    }

    /**
     * Set coach.
     *
     * @param string $coach
     *
     * @return Missions
     */
    public function setCoach($coach)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach.
     *
     * @return string
     */
    public function getCoach()
    {
        return $this->coach;
    }

    /**
     * Set idtour.
     *
     * @param string $idtour
     *
     * @return Missions
     */
    public function setIdtour($idtour)
    {
        $this->idtour = $idtour;

        return $this;
    }

    /**
     * Get idtour.
     *
     * @return string
     */
    public function getIdtour()
    {
        return $this->idtour;
    }

    /**
     * Set nomTour.
     *
     * @param string|null $nomTour
     *
     * @return Missions
     */
    public function setNomTour($nomTour = null)
    {
        $this->nomTour = $nomTour;

        return $this;
    }

    /**
     * Get nomTour.
     *
     * @return string|null
     */
    public function getNomTour()
    {
        return $this->nomTour;
    }

    /**
     * Set pax.
     *
     * @param string|null $pax
     *
     * @return Missions
     */
    public function setPax($pax = null)
    {
        $this->pax = $pax;

        return $this;
    }

    /**
     * Get pax.
     *
     * @return string|null
     */
    public function getPax()
    {
        return $this->pax;
    }

    /**
     * Set hotel.
     *
     * @param string $hotel
     *
     * @return Missions
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel.
     *
     * @return string
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set service.
     *
     * @param string $service
     *
     * @return Missions
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service.
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set heureSuppClient.
     *
     * @param \DateTime|null $heureSuppClient
     *
     * @return Missions
     */
    public function setHeureSuppClient($heureSuppClient = null)
    {
        $this->heureSuppClient = $heureSuppClient;

        return $this;
    }

    /**
     * Get heureSuppClient.
     *
     * @return \DateTime|null
     */
    public function getHeureSuppClient()
    {
        return $this->heureSuppClient;
    }

    /**
     * Set heureSuppEmploye.
     *
     * @param \DateTime|null $heureSuppEmploye
     *
     * @return Missions
     */
    public function setHeureSuppEmploye($heureSuppEmploye = null)
    {
        $this->heureSuppEmploye = $heureSuppEmploye;

        return $this;
    }

    /**
     * Get heureSuppEmploye.
     *
     * @return \DateTime|null
     */
    public function getHeureSuppEmploye()
    {
        return $this->heureSuppEmploye;
    }

    /**
     * Set noTcClient.
     *
     * @param float|null $noTcClient
     *
     * @return Missions
     */
    public function setNoTcClient($noTcClient = null)
    {
        $this->noTcClient = $noTcClient;

        return $this;
    }

    /**
     * Get noTcClient.
     *
     * @return float|null
     */
    public function getNoTcClient()
    {
        return $this->noTcClient;
    }

    /**
     * Set noTcEmploye.
     *
     * @param float|null $noTcEmploye
     *
     * @return Missions
     */
    public function setNoTcEmploye($noTcEmploye = null)
    {
        $this->noTcEmploye = $noTcEmploye;

        return $this;
    }

    /**
     * Get noTcEmploye.
     *
     * @return float|null
     */
    public function getNoTcEmploye()
    {
        return $this->noTcEmploye;
    }

    /**
     * Set debours.
     *
     * @param float|null $debours
     *
     * @return Missions
     */
    public function setDebours($debours = null)
    {
        $this->debours = $debours;

        return $this;
    }

    /**
     * Get debours.
     *
     * @return float|null
     */
    public function getDebours()
    {
        return $this->debours;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return Missions
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
     * Set idprestation.
     *
     * @param \AppBundle\Entity\Prestations|null $idprestation
     *
     * @return Missions
     */
    public function setIdprestation(\AppBundle\Entity\Prestations $idprestation = null)
    {
        $this->idprestation = $idprestation;

        return $this;
    }

    /**
     * Get idprestation.
     *
     * @return \AppBundle\Entity\Prestations|null
     */
    public function getIdprestation()
    {
        return $this->idprestation;
    }

    /**
     * Add idpersonne.
     *
     * @param \AppBundle\Entity\Personnes $idpersonne
     *
     * @return Missions
     */
    public function addIdpersonne(\AppBundle\Entity\Personnes $idpersonne)
    {
        $this->idpersonne[] = $idpersonne;

        return $this;
    }

    /**
     * Remove idpersonne.
     *
     * @param \AppBundle\Entity\Personnes $idpersonne
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIdpersonne(\AppBundle\Entity\Personnes $idpersonne)
    {
        return $this->idpersonne->removeElement($idpersonne);
    }

    /**
     * Get idpersonne.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }
}
