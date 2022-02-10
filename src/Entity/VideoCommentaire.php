<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideoCommentaireRepository;

/**
 * @ORM\Entity(repositoryClass=VideoCommentaireRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class VideoCommentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100000)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="videoCommentaires")
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Videos::class, inversedBy="videoCommentaires")
     */
    private $video;


    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (empty($this->date)) {
            $this->date = new DateTime();
        }
    }

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

    public function getVideo(): ?Videos
    {
        return $this->video;
    }

    public function setVideo(?Videos $video): self
    {
        $this->video = $video;

        return $this;
    }
}
