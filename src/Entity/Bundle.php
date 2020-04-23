<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BundleRepository")
 */
class Bundle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bundle")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bundle")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bundle")
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bundle")
     */
    private $conditionRating;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bundle")
     */
    private $cover;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("bundle")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("bundle")
     */
    private $dateModified;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="bundle")
     */    
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bundles")
     * @ORM\JoinColumn()
     * @Groups("user")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getConditionRating(): ?string
    {
        return $this->conditionRating;
    }

    public function setConditionRating(?string $conditionRating): self
    {
        $this->conditionRating = $conditionRating;

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

    public function getItems()
    {
        return $this->items;
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
    public function setUser($user)
    {
        $this->user = $user;
    }
}
