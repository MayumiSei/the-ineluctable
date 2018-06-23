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

    private $img;

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
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Material", mappedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_material")
     */
    private $materials;

    private $slides;

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

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
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

    public function getSlides() {
       return $this->slides;
    }

    public function setSlides($slides) {
        $this->slides = $slides;
        return $this;
    }
}
