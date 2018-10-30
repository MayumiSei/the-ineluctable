<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="AddressDelivery", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $addressDelivery;

    /**
     * @ORM\OneToOne(targetEntity="AddressBilling", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $addressBilling;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    protected $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        parent::__construct();
        $this->createdAt = new \Datetime('now');
    }

    public function getId() {
        return $this->id;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getAddressDelivery() {
        return $this->addressDelivery;
    }

    public function setAddressDelivery($addressDelivery) {
        $this->addressDelivery = $addressDelivery;
        return $this;
    }

    public function getAddressBilling() {
        return $this->addressBilling;
    }

    public function setAddressBilling($addressBilling) {
        $this->addressBilling = $addressBilling;
        return $this;
    }

    public function getOrders() {
        return $this->orders;
    }

    public function setOrders($orders) {
        $this->orders = $orders;
        return $this;
    }

    public function addOrder(Order $order) {
        if(!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }
        return $this;
    }

    public function removeOrder(Order $order) {
        if($this->orders->contains($order)) {
            $this->orders->removeElement($order);
        }
        return $this;
    }
}