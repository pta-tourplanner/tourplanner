<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saisons
 *
 * @ORM\Table(name="saisons")
 * @ORM\Entity
 */
class Saisons
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSaison", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsaison;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_saison", type="string", length=20, nullable=false)
     */
    private $nomSaison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="date", nullable=false)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date", nullable=false)
     */
    private $fin;



    /**
     * Get idsaison.
     *
     * @return int
     */
    public function getIdsaison()
    {
        return $this->idsaison;
    }

    /**
     * Set nomSaison.
     *
     * @param string $nomSaison
     *
     * @return Saisons
     */
    public function setNomSaison($nomSaison)
    {
        $this->nomSaison = $nomSaison;

        return $this;
    }

    /**
     * Get nomSaison.
     *
     * @return string
     */
    public function getNomSaison()
    {
        return $this->nomSaison;
    }

    /**
     * Set debut.
     *
     * @param \DateTime $debut
     *
     * @return Saisons
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin.
     *
     * @param \DateTime $fin
     *
     * @return Saisons
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin.
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }
}
