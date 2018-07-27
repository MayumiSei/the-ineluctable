<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_size")
     */
    private $sizes;

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
     * @ORM\ManyToMany(targetEntity="Material", mappedBy="products")
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

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
        $category->addProduct($this);
        return $this;
    }

    public function getSizes() {
        return $this->sizes;
    }

    public function setSize($sizes) {
        $this->sizes = $sizes;
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

    public function getCollection() {
        return $this->materials;
    }

    public function setCollection($collection) {
        $this->collection = $collection;
        return $this;
    }

    public function getShape() {
        return $this->materials;
    }

    public function setShape($shape) {
        $this->shape = $shape;
        return $this;
    }

    public function getGallery() {
        return $this->materials;
    }

    public function setGallery($gallery) {
        $this->gallery = $gallery;
        return $this;
    }
}
