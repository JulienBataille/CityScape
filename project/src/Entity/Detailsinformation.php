<?php

namespace App\Entity;

use App\Repository\DetailsinformationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsinformationRepository::class)]
class Detailsinformation
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $areaSize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sizePrefix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $landArea = null;

    #[ORM\Column(nullable: true)]
    private ?int $bedroom = null;

    #[ORM\Column(nullable: true)]
    private ?int $bathrooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $garages = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $yearBuild = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAreaSize(): ?string
    {
        return $this->areaSize;
    }

    public function setAreaSize(?string $areaSize): static
    {
        $this->areaSize = $areaSize;

        return $this;
    }

    public function getSizePrefix(): ?string
    {
        return $this->sizePrefix;
    }

    public function setSizePrefix(?string $sizePrefix): static
    {
        $this->sizePrefix = $sizePrefix;

        return $this;
    }

    public function getLandArea(): ?string
    {
        return $this->landArea;
    }

    public function setLandArea(?string $landArea): static
    {
        $this->landArea = $landArea;

        return $this;
    }

    public function getBedroom(): ?int
    {
        return $this->bedroom;
    }

    public function setBedroom(?int $bedroom): static
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(?int $bathrooms): static
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    public function getGarages(): ?int
    {
        return $this->garages;
    }

    public function setGarages(?int $garages): static
    {
        $this->garages = $garages;

        return $this;
    }

    public function getYearBuild(): ?\DateTimeInterface
    {
        return $this->yearBuild;
    }

    public function setYearBuild(?\DateTimeInterface $yearBuild): static
    {
        $this->yearBuild = $yearBuild;

        return $this;
    }
}
