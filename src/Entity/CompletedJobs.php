<?php

namespace App\Entity;

use App\Repository\CompletedJobsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompletedJobsRepository::class)
 */
class CompletedJobs
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
    private $jobCypher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jobName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roadName;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $finish;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $measurement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobCypher(): ?string
    {
        return $this->jobCypher;
    }

    public function setJobCypher(?string $jobCypher): self
    {
        $this->jobCypher = $jobCypher;

        return $this;
    }

    public function getJobName(): ?string
    {
        return $this->jobName;
    }

    public function setJobName(?string $jobName): self
    {
        $this->jobName = $jobName;

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

    public function getStart(): ?float
    {
        return $this->start;
    }

    public function setStart(?float $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?float
    {
        return $this->finish;
    }

    public function setFinish(?float $finish): self
    {
        $this->finish = $finish;

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

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
