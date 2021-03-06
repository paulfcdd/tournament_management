<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="leagues")
 * @ORM\Entity()
 */
class League extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column()
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $leagueRanking;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $numberOfClubs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="leagues")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Club", mappedBy="league")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
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
     * @return League
     */
    public function setName(string $name): League
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getLeagueRanking(): ?int
    {
        return $this->leagueRanking;
    }

    /**
     * @param int $leagueRanking
     * @return League
     */
    public function setLeagueRanking(int $leagueRanking): League
    {
        $this->leagueRanking = $leagueRanking;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfClubs(): ?int
    {
        return $this->numberOfClubs;
    }

    /**
     * @param int $numberOfClubs
     * @return League
     */
    public function setNumberOfClubs(int $numberOfClubs): League
    {
        $this->numberOfClubs = $numberOfClubs;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return League
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
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