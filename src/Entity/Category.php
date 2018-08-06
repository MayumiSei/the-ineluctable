<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $img;

    // connexion one to many entre category et product
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Type", mappedBy="category", orphanRemoval=true)
     */
    private $types;

    public function __construct() { // dès qu'on créé une catégorie, un tableau se créé
        $this->products = new ArrayCollection(); // tableau special de doctrine, collection, pas vraiment tableau
    }

    public function __toString() {
        $string = '';
        if($this->name)
            $string = $this->name;

        return $string;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product) { // on type $product, comme ça renvoie erreur si ce n'est pas un product (class)
        if(!$this->products->contains($product)) {
            $this->products[] = $product; // quand il y a des crochets puis un =, cela veut dire qu on ajoute
        }
        return $this;
    }

    public function removeProduct(Product $product) {
        if($this->products->contains($product)) {
            $this->products->removeElement($product);
        }
        return $this;
    }

    public function getTypes() {
        return $this->types;
    }

    public function setTypes($types) {
        $this->types = $types;
        return $this;
    }
}
