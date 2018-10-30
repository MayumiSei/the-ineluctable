<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;
//use App\Entity\Order;

/**
 * @ORM\Entity
 * @ORM\Table(name="orderProduct")
 */
class OrderProduct {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Product", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shape", inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $shape;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size", inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Color", inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $order;

    public function __construct() {
        $this->createdAt = new \Datetime('now');
    }

    public function __toString() {
        if($this->getProduct())
            return $this->getProduct()->getTitle();
        else
            return OrderProduct::class;
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


    public function getProduct() {
        return $this->product;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
        return $this;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setMaterial(Material $material) {
        $this->material = $material;
        return $this;
    }

    public function getShape() {
        return $this->shape;
    }

    public function setShape(Shape $shape) {
        $this->shape = $shape;
        return $this;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor(Color $color) {
        $this->color = $color;
        return $this;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize(Size $size) {
        $this->size = $size;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }
}
