<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

// enregistrer en BDD la table produit, déclarer à doctrine
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {

    // afin que ça entre en BDD
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Material", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_material")
     */
    private $materials;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collection", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shape", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shape;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery")
     */
    private $gallery;

    public function __construct() {
        $this->materials = new ArrayCollection();
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

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
        $category->addProduct($this);
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

    public function getMaterials() {
        return $this->materials;
    }

    public function setMaterials($materials) {
        $this->materials = $materials;
        return $this;
    }

    public function addMaterial(Material $material) {
        if(!$this->materials->contains($material)) {
            $this->materials[] = $material;
        }
        return $this;
    }

    public function removeMaterial(Material $material) {
        if($this->materials->contains($material)) {
            $this->materials->removeElement($material);
        }
        return $this;
    }

    public function getCollection() {
        return $this->collection;
    }

    public function setCollection($collection) {
        $this->collection = $collection;
        return $this;
    }

    public function getShape() {
        return $this->shape;
    }

    public function setShape($shape) {
        $this->shape = $shape;
        return $this;
    }

    public function getGallery() {
        return $this->gallery;
    }

    public function setGallery($gallery) {
        $this->gallery = $gallery;
        return $this;
    }
}
