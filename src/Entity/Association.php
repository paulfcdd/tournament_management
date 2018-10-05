<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="associations")
 * @ORM\Entity()
 */
class Association extends AbstractEntity
{
    public const CONTINENTS = [
        0 => 'North&Central America',
        1 => 'South America',
        2 => 'Europe',
        3 => 'Africa',
        4 => 'Asia',
        5 => 'Oceania',
    ];

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $continent;

    /**
     * @var string
     * @ORM\Column(unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Country", mappedBy="association")
     */
    private $countries;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getContinent(): ?int
    {
        return $this->continent;
    }

    /**
     * @param int $continent
     * @return Association
     */
    public function setContinent(int $continent): Association
    {
        $this->continent = $continent;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Association
     */
    public function setName(string $name): Association
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Country $country
     * @return $this
     */
    public function addCountry(Country $country)
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
        }

        return $this;
    }

    /**
     * @param Country $country
     * @return $this
     */
    public function removeCountry(Country $country)
    {
        if ($this->countries->contains($country)) {
            $this->countries->remove($country);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCountries()
    {
        return $this->countries;
    }
}