<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $actif = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $documentProve = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $userName = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $coverImg = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $postCode = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $biography = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $expireToken = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getActif(): ?int
    {
        return $this->actif;
    }

    public function setActif(?int $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getDocumentProve(): ?string
    {
        return $this->documentProve;
    }

    public function setDocumentProve(?string $documentProve): static
    {
        $this->documentProve = $documentProve;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCoverImg(): ?string
    {
        return $this->coverImg;
    }

    public function setCoverImg(?string $coverImg): static
    {
        $this->coverImg = $coverImg;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): static
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): static
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    public function getExpireToken(): ?\DateTimeImmutable
    {
        return $this->expireToken;
    }

    public function setExpireToken(?\DateTimeImmutable $expireToken): static
    {
        $this->expireToken = $expireToken;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
