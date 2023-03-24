<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AboutRepository::class)
 */
class About
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstPicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondPicture;

    /**
     * @ORM\Column(type="text")
     */
    private $firsttext;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $secondText;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstPicture(): ?string
    {
        return $this->firstPicture;
    }

    public function setFirstPicture(string $firstPicture): self
    {
        $this->firstPicture = $firstPicture;

        return $this;
    }

    public function getSecondPicture(): ?string
    {
        return $this->secondPicture;
    }

    public function setSecondPicture(string $secondPicture): self
    {
        $this->secondPicture = $secondPicture;

        return $this;
    }

    public function getFirsttext(): ?string
    {
        return $this->firsttext;
    }

    public function setFirsttext(string $firsttext): self
    {
        $this->firsttext = $firsttext;

        return $this;
    }

    public function getSecondText(): ?string
    {
        return $this->secondText;
    }

    public function setSecondText(?string $secondText): self
    {
        $this->secondText = $secondText;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
