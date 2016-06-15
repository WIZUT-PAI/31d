<?php

namespace ParcelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ParcelBundle\Model\ParcelInterface;
/**
 * Parcel
 *
 * @ORM\Table(name="parcel")
 * @ORM\Entity(repositoryClass="ParcelBundle\Repository\ParcelRepository")
 */
class Parcel implements ParcelInterface
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
     * @ORM\Column(name="id_Sender", type="integer")
     */
    private $idSender;

    /**
     * @var int
     *
     * @ORM\Column(name="id_Receiver", type="integer")
     */
    private $idReceiver;

    /**
     * @var int
     *
     * @ORM\Column(name="id_Postman", type="integer")
     */
    private $idPostman;

    /**
     * @var string
     *
     * @ORM\Column(name="Notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * @var int
     *
     * @ORM\Column(name="parcel_hash", type="integer", unique=true)
     */
    private $parcelHash;


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
     * Set idSender
     *
     * @param integer $idSender
     *
     * @return Parcel
     */
    public function setIdSender($idSender)
    {
        $this->idSender = $idSender;

        return $this;
    }

    /**
     * Get idSender
     *
     * @return int
     */
    public function getIdSender()
    {
        return $this->idSender;
    }

    /**
     * Set idReceiver
     *
     * @param integer $idReceiver
     *
     * @return Parcel
     */
    public function setIdReceiver($idReceiver)
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    /**
     * Get idReceiver
     *
     * @return int
     */
    public function getIdReceiver()
    {
        return $this->idReceiver;
    }

    /**
     * Set idPostman
     *
     * @param integer $idPostman
     *
     * @return Parcel
     */
    public function setIdPostman($idPostman)
    {
        $this->idPostman = $idPostman;

        return $this;
    }

    /**
     * Get idPostman
     *
     * @return int
     */
    public function getIdPostman()
    {
        return $this->idPostman;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Parcel
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set parcelHash
     *
     * @param integer $parcelHash
     *
     * @return Parcel
     */
    public function setParcelHash($parcelHash)
    {
        $this->parcelHash = $parcelHash;

        return $this;
    }

    /**
     * Get parcelHash
     *
     * @return int
     */
    public function getParcelHash()
    {
        return $this->parcelHash;
    }
}

