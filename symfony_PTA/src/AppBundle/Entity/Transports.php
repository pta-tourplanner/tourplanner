<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transports
 *
 * @ORM\Table(name="transports")
 * @ORM\Entity
 */
class Transports
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTransport", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransport;

    /**
     * @var string
     *
     * @ORM\Column(name="type_transport", type="string", length=30, nullable=false)
     */
    private $typeTransport;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=18, nullable=true)
     */
    private $telephone;



    /**
     * Get idtransport.
     *
     * @return int
     */
    public function getIdtransport()
    {
        return $this->idtransport;
    }

    /**
     * Set typeTransport.
     *
     * @param string $typeTransport
     *
     * @return Transports
     */
    public function setTypeTransport($typeTransport)
    {
        $this->typeTransport = $typeTransport;

        return $this;
    }

    /**
     * Get typeTransport.
     *
     * @return string
     */
    public function getTypeTransport()
    {
        return $this->typeTransport;
    }

    /**
     * Set telephone.
     *
     * @param string|null $telephone
     *
     * @return Transports
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
}
