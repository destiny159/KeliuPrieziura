<?php

namespace App\Entity;

use App\Repository\JobCypherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobCypherRepository::class)
 */
class JobCypher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cypher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $measurement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCypher(): ?string
    {
        return $this->cypher;
    }

    public function setCypher(?string $cypher): self
    {
        $this->cypher = $cypher;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMeasurement(): ?string
    {
        return $this->measurement;
    }

    public function setMeasurement(?string $measurement): self
    {
        $this->measurement = $measurement;

        return $this;
    }
}
