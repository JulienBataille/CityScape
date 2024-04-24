<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[Vich\Uploadable]
class Property
{



    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = 'fr';

    #[ORM\Column(length: 255)]
    private ?string $propertyTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'properties', cascade:['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $statuts = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $area = null;

    #[ORM\ManyToOne(inversedBy: 'properties', cascade:['persist', 'remove'])]
    private ?User $agentImmo = null;

    #[ORM\OneToMany(targetEntity: Gallery::class, mappedBy: 'property', cascade:['persist', 'remove'])]
    private Collection $pictures;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Detailsinformation $detailsInformation = null;

    #[ORM\OneToMany(targetEntity: Amenities::class, mappedBy: 'property', cascade:['persist', 'remove'])]
    private Collection $amenities;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'property', cascade:['persist', 'remove'])]
    private Collection $carts;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->amenities = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    public function getPropertyTitle(): ?string
    {
        return $this->propertyTitle;
    }

    public function setPropertyTitle(string $propertyTitle): static
    {
        $this->propertyTitle = $propertyTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatuts(): ?Category
    {
        return $this->statuts;
    }

    public function setStatuts(?Category $statuts): static
    {
        $this->statuts = $statuts;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getAgentImmo(): ?User
    {
        return $this->agentImmo;
    }

    public function setAgentImmo(?User $agentImmo): static
    {
        $this->agentImmo = $agentImmo;

        return $this;
    }

    /**
     * @return Collection<int, Gallery>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Gallery $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Gallery $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    public function getDetailsInformation(): ?Detailsinformation
    {
        return $this->detailsInformation;
    }

    public function setDetailsInformation(?Detailsinformation $detailsInformation): static
    {
        $this->detailsInformation = $detailsInformation;

        return $this;
    }

    /**
     * @return Collection<int, Amenities>
     */
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Amenities $amenity): static
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities->add($amenity);
            $amenity->setProperty($this);
        }

        return $this;
    }

    public function removeAmenity(Amenities $amenity): static
    {
        if ($this->amenities->removeElement($amenity)) {
            // set the owning side to null (unless already changed)
            if ($amenity->getProperty() === $this) {
                $amenity->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->addProperty($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeProperty($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
