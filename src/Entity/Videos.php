<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideosRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=VideosRepository::class)
 *  @ORM\HasLifecycleCallbacks
 */
class Videos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $partager;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $video;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireVideo::class, mappedBy="videoes")
     */
    private $commentaireVideos;

    public function __construct()
    {
        $this->commentaireVideos = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */

    public function PrePersist()
    {
        if (empty($this->date)) {
            $this->date = new DateTime();
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
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

    public function getPartager(): ?string
    {
        return $this->partager;
    }

    public function setPartager(string $partager): self
    {
        $this->partager = $partager;

        return $this;
    }

    public function getVideo(): ?User
    {
        return $this->video;
    }

    public function setVideo(?User $video): self
    {
        $this->video = $video;

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

    public function __toString()
    {
        return $this->titre;
    }

    /**
     * @return Collection|CommentaireVideo[]
     */
    public function getCommentaireVideos(): Collection
    {
        return $this->commentaireVideos;
    }

    public function addCommentaireVideo(CommentaireVideo $commentaireVideo): self
    {
        if (!$this->commentaireVideos->contains($commentaireVideo)) {
            $this->commentaireVideos[] = $commentaireVideo;
            $commentaireVideo->setVideoes($this);
        }

        return $this;
    }

    public function removeCommentaireVideo(CommentaireVideo $commentaireVideo): self
    {
        if ($this->commentaireVideos->removeElement($commentaireVideo)) {
            // set the owning side to null (unless already changed)
            if ($commentaireVideo->getVideoes() === $this) {
                $commentaireVideo->setVideoes(null);
            }
        }

        return $this;
    }
}
