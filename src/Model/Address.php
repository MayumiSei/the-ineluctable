<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(name="address")
 */
class Address {

    /**
     * @ORM\Column(type="string")
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     */
    protected $street;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $streetAdd;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="integer")
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $state;

    public function __construct() {

    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function getStreetAdd() {
        return $this->streetAdd;
    }

    public function setStreetAdd($streetAdd) {
        $this->streetAdd = $streetAdd;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
}
