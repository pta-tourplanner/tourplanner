<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comptes
 *
 * @ORM\Table(name="comptes", indexes={@ORM\Index(name="fk_Comptes_Personnes1", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Comptes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCompte", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcompte;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_passe", type="string", length=15, nullable=false)
     */
    private $motPasse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=45, nullable=true)
     */
    private $photo;

    /**
     * @var \AppBundle\Entity\Personnes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Personnes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;



    /**
     * Set idcompte.
     *
     * @param int $idcompte
     *
     * @return Comptes
     */
    public function setIdcompte($idcompte)
    {
        $this->idcompte = $idcompte;

        return $this;
    }

    /**
     * Get idcompte.
     *
     * @return int
     */
    public function getIdcompte()
    {
        return $this->idcompte;
    }

    /**
     * Set motPasse.
     *
     * @param string $motPasse
     *
     * @return Comptes
     */
    public function setMotPasse($motPasse)
    {
        $this->motPasse = $motPasse;

        return $this;
    }

    /**
     * Get motPasse.
     *
     * @return string
     */
    public function getMotPasse()
    {
        return $this->motPasse;
    }

    /**
     * Set photo.
     *
     * @param string|null $photo
     *
     * @return Comptes
     */
    public function setPhoto($photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo.
     *
     * @return string|null
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set idpersonne.
     *
     * @param \AppBundle\Entity\Personnes $idpersonne
     *
     * @return Comptes
     */
    public function setIdpersonne(\AppBundle\Entity\Personnes $idpersonne)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne.
     *
     * @return \AppBundle\Entity\Personnes
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }
}
