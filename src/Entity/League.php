<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="leagues")
 * @ORM\Entity()
 */
class League extends AbstractEntity
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(unique=true)
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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


//    private $clubs;

}