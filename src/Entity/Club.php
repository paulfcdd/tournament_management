<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="clubs")
 * @ORM\Entity()
 */
class Club extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column()
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $founded;

    /**
     * @var string
     * @ORM\Column()
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stadium", inversedBy="clubs")
     * @ORM\JoinColumn(name="stadium_id", referencedColumnName="id")
     */
    private $stadium;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="clubs")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $league;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Club
     */
    public function setName(string $name): Club
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getFounded(): int
    {
        return $this->founded;
    }

    /**
     * @param int $founded
     * @return Club
     */
    public function setFounded(int $founded): Club
    {
        $this->founded = $founded;
        return $this;
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
     * @return Club
     */
    public function setLocation(string $location): Club
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * @param mixed $stadium
     * @return Club
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param mixed $league
     * @return Club
     */
    public function setLeague($league)
    {
        $this->league = $league;
        return $this;
    }
}