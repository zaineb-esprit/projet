<?php

namespace App\Entity;

use App\Repository\ResmaisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResmaisonRepository::class)
 */
class Resmaison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateentre;

    /**
     * @ORM\Column(type="date")
     */
    private $datesortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateentre(): ?\DateTimeInterface
    {
        return $this->dateentre;
    }

    public function setDateentre(\DateTimeInterface $dateentre): self
    {
        $this->dateentre = $dateentre;

        return $this;
    }

    public function getDatesortie(): ?\DateTimeInterface
    {
        return $this->datesortie;
    }

    public function setDatesortie(\DateTimeInterface $datesortie): self
    {
        $this->datesortie = $datesortie;

        return $this;
    }
}
