<?php

namespace App\Entity;

use App\Repository\ImgRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImgRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Img
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="imgs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $imga;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImga(): ?User
    {
        return $this->imga;
    }

    public function setImga(?User $imga): self
    {
        $this->imga = $imga;

        return $this;
    }

    public function getVu(): ?string
    {
        return $this->vu;
    }

    public function setVu(string $vu): self
    {
        $this->vu = $vu;

        return $this;
    }
}
