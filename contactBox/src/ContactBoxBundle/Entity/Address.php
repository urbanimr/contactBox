<?php

namespace ContactBoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="ContactBoxBundle\Repository\AddressRepository")
 */
class Address
{

    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */

    private $person;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=25)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=25)
     */
    private $street;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="apartmentNumber", type="integer")
     */
    private $apartmentNumber;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set apartmentNumber
     *
     * @param integer $apartmentNumber
     * @return Address
     */
    public function setApartmentNumber($apartmentNumber)
    {
        $this->apartmentNumber = $apartmentNumber;

        return $this;
    }

    /**
     * Get apartmentNumber
     *
     * @return integer 
     */
    public function getApartmentNumber()
    {
        return $this->apartmentNumber;
    }
}
