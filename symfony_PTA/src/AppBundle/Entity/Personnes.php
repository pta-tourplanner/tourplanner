<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnes
 *
 * @ORM\Table(name="personnes")
 * @ORM\Entity
 */
class Personnes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPersonne", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genre", type="string", length=3, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=15, nullable=false)
     */
    private $fonction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=30, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pays", type="string", length=30, nullable=true)
     */
    private $pays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=18, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=18, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=500, nullable=true)
     */
    private $note;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Missions", mappedBy="idpersonne")
     */
    private $idmission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idmission = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idpersonne.
     *
     * @return int
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Personnes
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Personnes
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set genre.
     *
     * @param string|null $genre
     *
     * @return Personnes
     */
    public function setGenre($genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre.
     *
     * @return string|null
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set fonction.
     *
     * @param string $fonction
     *
     * @return Personnes
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction.
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set adresse.
     *
     * @param string|null $adresse
     *
     * @return Personnes
     */
    public function setAdresse($adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string|null
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal.
     *
     * @param int|null $codePostal
     *
     * @return Personnes
     */
    public function setCodePostal($codePostal = null)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal.
     *
     * @return int|null
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville.
     *
     * @param string|null $ville
     *
     * @return Personnes
     */
    public function setVille($ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays.
     *
     * @param string|null $pays
     *
     * @return Personnes
     */
    public function setPays($pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays.
     *
     * @return string|null
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Personnes
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone.
     *
     * @param string|null $telephone
     *
     * @return Personnes
     */
    public function setTelephone($telephone = null)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax.
     *
     * @param string|null $fax
     *
     * @return Personnes
     */
    public function setFax($fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax.
     *
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return Personnes
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
     * Add idmission.
     *
     * @param \AppBundle\Entity\Missions $idmission
     *
     * @return Personnes
     */
    public function addIdmission(\AppBundle\Entity\Missions $idmission)
    {
        $this->idmission[] = $idmission;

        return $this;
    }

    /**
     * Remove idmission.
     *
     * @param \AppBundle\Entity\Missions $idmission
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIdmission(\AppBundle\Entity\Missions $idmission)
    {
        return $this->idmission->removeElement($idmission);
    }

    /**
     * Get idmission.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdmission()
    {
        return $this->idmission;
    }
}
