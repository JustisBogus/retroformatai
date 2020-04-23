<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("item")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("item")
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $genre1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $genre2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $region;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("item")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("item")
     */
    private $conditionRating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("item")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("item")
     */
    private $cover;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("item")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("item")
     */
    private $dateModified;

    /**
     * 
     */
    private $honeypot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="items")
     * @ORM\JoinColumn()
     * @Groups("user")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bundle", inversedBy="items")
     * @ORM\JoinColumn()
     * @Groups("bundle")
     */
    private $bundle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getGenre1(): ?string
    {
        return $this->genre1;
    }

    public function setGenre1(?string $genre1): self
    {
        $this->genre1 = $genre1;

        return $this;
    }

    public function getGenre2(): ?string
    {
        return $this->genre2;
    }

    public function setGenre2(?string $genre2): self
    {
        $this->genre2 = $genre2;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?int $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(?string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getConditionRating(): ?int
    {
        return $this->conditionRating;
    }

    public function setConditionRating(?int $conditionRating): self
    {
        $this->conditionRating = $conditionRating;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getHoneyPot()
    {
        return $this->honeypot;
    }

  
    public function setHoneyPot(string $honeypot): self
    {
        $this->honeypot = $honeypot;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
    * @param UserInterface $user
    */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getBundle()
    {
        return $this->bundle;
    }

    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    }
}
