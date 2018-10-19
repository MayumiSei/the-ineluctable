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
     * @ORM\OneToMany(targetEntity="App\Entity\Type", mappedBy="category", orphanRemoval=true)
     */
    private $types;

    public function __construct() {
        $this->types = new ArrayCollection();
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

    public function getTypes() {
        return $this->types;
    }

    public function setTypes($types) {
        $this->types = $types;
        return $this;
    }

    public function addType(Type $type) {
        $type->setCategory($this);
        if(!$this->types->contains($type)) {
            $this->types[] = $type;
        }
        return $this;
    }

    public function removeType(Type $type) {
        if($this->types->contains($type)) {
            $this->types->removeElement($type);
        }
        return $this;
    }
}
