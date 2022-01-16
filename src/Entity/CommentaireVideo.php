<?php

namespace App\Entity;

use App\Repository\CommentaireVideoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireVideoRepository::class)
 */
class CommentaireVideo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaireVideos")
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Videos::class, inversedBy="commentaireVideos")
     */
    private $videoes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getVideoes(): ?Videos
    {
        return $this->videoes;
    }

    public function setVideoes(?Videos $videoes): self
    {
        $this->videoes = $videoes;

        return $this;
    }
}
