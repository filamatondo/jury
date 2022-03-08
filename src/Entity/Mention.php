<?php

namespace App\Entity;

use App\Repository\MentionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentionRepository::class)
 *  @ORM\HasLifecycleCallbacks
 */
class Mention
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
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mentions")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $mentions;

    /**
     * @ORM\Column(type="string", length=100000)
     */
    private $articl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getArticles(): ?string
    {
        return $this->articles;
    }

    public function setArticles(string $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getMentions(): ?User
    {
        return $this->mentions;
    }

    public function setMentions(?User $mentions): self
    {
        $this->mentions = $mentions;

        return $this;
    }


    public function __toString()
    {
        return $this->mentions;
    }

    public function getArticl(): ?string
    {
        return $this->articl;
    }

    public function setArticl(string $articl): self
    {
        $this->articl = $articl;

        return $this;
    }
}
