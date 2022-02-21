<?php

namespace App\Entity;

use DateTime;
use App\Entity\Article;
use App\Entity\Messages;
use App\Entity\Commentaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Cet email n'est pas valide.")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Vous devez ajouter un email")
     */
    private $email = 0;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez ajouter un nom de famille")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez ajouter un prénom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="sender", orphanRemoval=true)
     */
    private $sent;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="recipient",  orphanRemoval=true)
     */
    private $received;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="auteur", orphanRemoval=true)
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="auteur", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Img::class, mappedBy="imga", orphanRemoval=true)
     */
    private $imgs;

    /**
     * @ORM\OneToMany(targetEntity=Videos::class, mappedBy="video", orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoProfil;

    /**
     * @ORM\OneToMany(targetEntity=Apropo::class, mappedBy="videos", orphanRemoval=true)
     */
    private $apropos;

    /**
     * @ORM\OneToMany(targetEntity=Mention::class, mappedBy="mentions", orphanRemoval=true)
     */
    private $mentions;

    /**
     * @ORM\ManyToMany(targetEntity=ListeAmiAjouter::class, mappedBy="listeAjouter")
     */
    private $listeAmiAjouters;

    /**
     * @ORM\OneToMany(targetEntity=VideoCommentaire::class, mappedBy="auteur")
     */
    private $videoCommentaires;




    /**
     * @var \DateTime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (empty($this->date)) {
            $this->date = new DateTime();
        }
    }

    public function __construct()
    {
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->imgs = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->apropos = new ArrayCollection();
        $this->mentions = new ArrayCollection();
        $this->listeAmiAjouters = new ArrayCollection();
        $this->videoCommentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Messages $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent[] = $sent;
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Messages $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Messages $received): self
    {
        if (!$this->received->contains($received)) {
            $this->received[] = $received;
            $received->setRecipient($this);
        }

        return $this;
    }

    public function removeReceived(Messages $received): self
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecipient() === $this) {
                $received->setRecipient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuteur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuteur() === $this) {
                $article->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAuteur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAuteur() === $this) {
                $commentaire->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Img[]
     */
    public function getImgs(): Collection
    {
        return $this->imgs;
    }

    public function addImg(Img $img): self
    {
        if (!$this->imgs->contains($img)) {
            $this->imgs[] = $img;
            $img->setImga($this);
        }

        return $this;
    }

    public function removeImg(Img $img): self
    {
        if ($this->imgs->removeElement($img)) {
            // set the owning side to null (unless already changed)
            if ($img->getImga() === $this) {
                $img->setImga(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return (string) $this->getNom();
    }

    /**
     * @return Collection|Videos[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Videos $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setVideo($this);
        }

        return $this;
    }

    public function removeVideo(Videos $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getVideo() === $this) {
                $video->setVideo(null);
            }
        }

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): self
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }


    // public function __toString()
    // {
    //     return $this->titre; 
    // }

    /**
     * @return Collection|Apropo[]
     */
    public function getApropos(): Collection
    {
        return $this->apropos;
    }

    public function addApropo(Apropo $apropo): self
    {
        if (!$this->apropos->contains($apropo)) {
            $this->apropos[] = $apropo;
            $apropo->setVideos($this);
        }

        return $this;
    }

    public function removeApropo(Apropo $apropo): self
    {
        if ($this->apropos->removeElement($apropo)) {
            // set the owning side to null (unless already changed)
            if ($apropo->getVideos() === $this) {
                $apropo->setVideos(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mention[]
     */
    public function getMentions(): Collection
    {
        return $this->mentions;
    }

    public function addMention(Mention $mention): self
    {
        if (!$this->mentions->contains($mention)) {
            $this->mentions[] = $mention;
            $mention->setMentions($this);
        }

        return $this;
    }

    public function removeMention(Mention $mention): self
    {
        if ($this->mentions->removeElement($mention)) {
            // set the owning side to null (unless already changed)
            if ($mention->getMentions() === $this) {
                $mention->setMentions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ListeAmiAjouter[]
     */
    public function getListeAmiAjouters(): Collection
    {
        return $this->listeAmiAjouters;
    }

    public function addListeAmiAjouter(ListeAmiAjouter $listeAmiAjouter): self
    {
        if (!$this->listeAmiAjouters->contains($listeAmiAjouter)) {
            $this->listeAmiAjouters[] = $listeAmiAjouter;
            $listeAmiAjouter->addListeAjouter($this);
        }

        return $this;
    }

    public function removeListeAmiAjouter(ListeAmiAjouter $listeAmiAjouter): self
    {
        if ($this->listeAmiAjouters->removeElement($listeAmiAjouter)) {
            $listeAmiAjouter->removeListeAjouter($this);
        }

        return $this;
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
            $videoCommentaire->setAuteur($this);
        }

        return $this;
    }

    public function removeVideoCommentaire(VideoCommentaire $videoCommentaire): self
    {
        if ($this->videoCommentaires->removeElement($videoCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($videoCommentaire->getAuteur() === $this) {
                $videoCommentaire->setAuteur(null);
            }
        }

        return $this;
    }
}
