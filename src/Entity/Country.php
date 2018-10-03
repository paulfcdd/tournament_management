<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="countries")
 * @ORM\Entity()
 */
class Country extends AbstractEntity
{
    /**
     * @var integer
     * @ORM\Column(type="integer", length=20)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Association", inversedBy="id")
     */
    private $association;
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
}