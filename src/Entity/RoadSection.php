<?php

namespace App\Entity;

use App\Repository\RoadSectionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadSectionRepository::class)
 */
class RoadSection
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
    private $roadNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roadName;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $roadStart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $roadFinish;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roadLevel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roadType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoadNumber(): ?string
    {
        return $this->roadNumber;
    }

    public function setRoadNumber(?string $roadNumber): self
    {
        $this->roadNumber = $roadNumber;

        return $this;
    }

    public function getRoadName(): ?string
    {
        return $this->roadName;
    }

    public function setRoadName(?string $roadName): self
    {
        $this->roadName = $roadName;

        return $this;
    }

    public function getRoadStart(): ?float
    {
        return $this->roadStart;
    }

    public function setRoadStart(?float $roadStart): self
    {
        $this->roadStart = $roadStart;

        return $this;
    }

    public function getRoadFinish(): ?float
    {
        return $this->roadFinish;
    }

    public function setRoadFinish(?float $roadFinish): self
    {
        $this->roadFinish = $roadFinish;

        return $this;
    }

    public function getRoadLevel(): ?int
    {
        return $this->roadLevel;
    }

    public function setRoadLevel(?int $roadLevel): self
    {
        $this->roadLevel = $roadLevel;

        return $this;
    }

    public function getRoadType(): ?string
    {
        return $this->roadType;
    }

    public function setRoadType(?string $roadType): self
    {
        $this->roadType = $roadType;

        return $this;
    }
}
