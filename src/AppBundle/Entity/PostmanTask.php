<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostmanTask
 *
 * @ORM\Table(name="postman_task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostmanTaskRepository")
 */
class PostmanTask
{
    /**
      * @ORM\OneToOne(targetEntity="Postman")
      * @ORM\JoinColumn(name="postman_id", referencedColumnName="id")
      */
    protected $postman;

    /**
      * @ORM\OneToOne(targetEntity="ParcelOrder")
      * @ORM\JoinColumn(name="parcel_order_id", referencedColumnName="id")
      */
    protected $parcel_order;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;


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
     * Set done
     *
     * @param boolean $done
     *
     * @return PostmanTask
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return bool
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set postman
     *
     * @param \AppBundle\Entity\Postman $postman
     *
     * @return PostmanTask
     */
    public function setPostman(\AppBundle\Entity\Postman $postman = null)
    {
        $this->postman = $postman;

        return $this;
    }

    /**
     * Get postman
     *
     * @return \AppBundle\Entity\Postman
     */
    public function getPostman()
    {
        return $this->postman;
    }

    /**
     * Set parcelOrder
     *
     * @param \AppBundle\Entity\ParcelOrder $parcelOrder
     *
     * @return PostmanTask
     */
    public function setParcelOrder(\AppBundle\Entity\ParcelOrder $parcelOrder = null)
    {
        $this->parcel_order = $parcelOrder;

        return $this;
    }

    /**
     * Get parcelOrder
     *
     * @return \AppBundle\Entity\ParcelOrder
     */
    public function getParcelOrder()
    {
        return $this->parcel_order;
    }
}
