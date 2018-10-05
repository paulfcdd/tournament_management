<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="countries")
 * @ORM\Entity()
 */
class Country extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column(unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Association", inversedBy="countries")
     * @ORM\JoinColumn(name="association_id", referencedColumnName="id")
     */
    private $association;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\League", mappedBy="country")
     */
    private $leagues;

    public function __construct()
    {
        $this->leagues = new ArrayCollection();
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
     * @return Country
     */
    public function setName(string $name): Country
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param mixed $association
     * @return Country
     */
    public function setAssociation($association)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * @param \App\Entity\League $league
     * @return $this
     */
    public function addLeague(League $league)
    {
        if (!$this->leagues->contains($league)) {
            $this->leagues->add($league);
        }

        return $this;
    }

    /**
     * @param \App\Entity\League $league
     * @return $this
     */
    public function removeLeague(League $league)
    {
        if ($this->leagues->contains($league)) {
            $this->leagues->remove($league);
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getLeagues()
    {
        return $this->leagues;
    }
}