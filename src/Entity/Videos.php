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
     * @ORM\OneToMany(targetEntity=VideoCommentaire::class, mappedBy="video")
     */
    private $videoCommentaires;

    public function __construct()
    {
        $this->videoCommentaires = new ArrayCollection();
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
     * @return Collection|VideoCommentaire[]
     */
    public function getVideoCommentaires(): Collection
    {
        return $this->videoCommentaires;
    }

    public function addVideoCommentaire(VideoCommentaire $videoCommentaire): self
    {
        if (!$this->videoCommentaires->contains($videoCommentaire)) {
            $this->videoCommentaires[] = $videoCommentaire;
            $videoCommentaire->setVideo($this);
        }

        return $this;
    }

    public function removeVideoCommentaire(VideoCommentaire $videoCommentaire): self
    {
        if ($this->videoCommentaires->removeElement($videoCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($videoCommentaire->getVideo() === $this) {
                $videoCommentaire->setVideo(null);
            }
        }

        return $this;
    }
}
