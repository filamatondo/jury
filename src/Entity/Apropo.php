<?php

namespace App\Entity;

use App\Repository\ApropoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApropoRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Apropo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="apropos")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paragraphe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $biographie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideos(): ?User
    {
        return $this->videos;
    }

    public function setVideos(?User $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getParagraphe(): ?string
    {
        return $this->paragraphe;
    }

    public function setParagraphe(string $paragraphe): self
    {
        $this->paragraphe = $paragraphe;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }


    public function __toString()
    {
        return $this->titre;
    }
}
