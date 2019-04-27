<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {

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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material")
     * @ORM\JoinColumn(nullable=false)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collection")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="Shape")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_shapes")
     */
    private $shapes;

    /**
     * @ORM\ManyToMany(targetEntity="Size")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_sizes")
     */
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Color")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_colors")
     */
    private $colors;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery", cascade={"persist", "remove"})
     */
    private $gallery;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\State")
     * @ORM\JoinColumn(nullable=true)
     */
    private $state;

    public function __construct() {
        $this->shapes = new ArrayCollection();
        $this->sizes = new ArrayCollection();
        $this->colors = new ArrayCollection();
        $this->createdAt = new \Datetime('now');
    }

    public function __toString() {
        $string = '';
        if($this->title)
            $string = $this->title;

        return $string;
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

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setMaterial($material) {
        $this->material = $material;
        return $this;
    }

    public function getCollection() {
        return $this->collection;
    }

    public function setCollection($collection) {
        $this->collection = $collection;
        return $this;
    }

    public function getShapes() {
        return $this->shapes;
    }

    public function setShapes($shapes) {
        $this->shapes = $shapes;
        return $this;
    }

    public function addShape(Shape $shape) {
        if(!$this->shapes->contains($shape)) {
            $this->shapes[] = $shape;
        }
        return $this;
    }

    public function removeShape(Shape $shape) {
        if($this->shapes->contains($shape)) {
            $this->shapes->removeElement($shape);
        }
        return $this;
    }

    public function getColors() {
        return $this->colors;
    }

    public function setColors($colors) {
        $this->colors = $colors;
        return $this;
    }

    public function addColor(Color $color) {
        if(!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }
        return $this;
    }

    public function removeColor(Color $color) {
        if($this->colors->contains($color)) {
            $this->colors->removeElement($color);
        }
        return $this;
    }

    public function getSizes() {
        return $this->sizes;
    }

    public function setSizes($sizes) {
        $this->sizes = $sizes;
        return $this;
    }

    public function addSize(Size $size) {
        if(!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
        }
        return $this;
    }

    public function removeSize(Size $size) {
        if($this->sizes->contains($size)) {
            $this->sizes->removeElement($size);
        }
        return $this;
    }

    public function getGallery() {
        return $this->gallery;
    }

    public function setGallery($gallery) {
        $this->gallery = $gallery;
        return $this;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }
}
