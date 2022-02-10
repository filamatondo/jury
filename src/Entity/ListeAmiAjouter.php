<?php

namespace App\Entity;

use App\Repository\ListeAmiAjouterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeAmiAjouterRepository::class)
 */
class ListeAmiAjouter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="listeAmiAjouters")
     */
    private $listeAjouter;

    public function __construct()
    {
        $this->listeAjouter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getListeAjouter(): Collection
    {
        return $this->listeAjouter;
    }

    public function addListeAjouter(User $listeAjouter): self
    {
        if (!$this->listeAjouter->contains($listeAjouter)) {
            $this->listeAjouter[] = $listeAjouter;
        }

        return $this;
    }

    public function removeListeAjouter(User $listeAjouter): self
    {
        $this->listeAjouter->removeElement($listeAjouter);

        return $this;
    }
}
