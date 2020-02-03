<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServerLoadRepository")
 */
class ServerLoad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\Version
     */
    private $timestamp;

    /**
     * @ORM\Column(type="float")
     */
    private $cpuLoad;

    /**
     * @ORM\Column(type="integer")
     */
    private $concurrency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getCpuLoad(): ?float
    {
        return $this->cpuLoad;
    }

    public function setCpuLoad(float $cpuLoad): self
    {
        $this->cpuLoad = $cpuLoad;

        return $this;
    }

    public function getConcurrency(): ?int
    {
        return $this->concurrency;
    }

    public function setConcurrency(int $concurrency): self
    {
        $this->concurrency = $concurrency;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'timestamp' => $this->getTimestamp(),
            'cpuLoad' => $this->getCpuLoad(),
            'concurrency' => $this->getConcurrency(),
        ];
    }
}
