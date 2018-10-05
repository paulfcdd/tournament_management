<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="stadiums")
 * @ORM\Entity()
 */
class Stadium extends AbstractEntity
{

    /**
     * @var string
     * @ORM\Column()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column()
     */
    private $location;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $builded;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Club", mappedBy="stadium")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return int
     */
    public function getBuilded(): int
    {
        return $this->builded;
    }

    /**
     * @param int $builded
     */
    public function setBuilded(int $builded): void
    {
        $this->builded = $builded;
    }

    /**
     * @param \App\Entity\Club $club
     * @return $this
     */
    public function addClub(Club $club)
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
        }

        return $this;
    }

    /**
     * @param \App\Entity\Club $club
     * @return $this
     */
    public function removeClub(Club $club)
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->remove($club);
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getClubs()
    {
        return $this->clubs;
    }
}