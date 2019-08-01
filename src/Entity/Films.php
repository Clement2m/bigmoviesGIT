<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmsRepository")
 */
class Films
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom_film;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $affiche;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Critique", mappedBy="film")
     */
    private $critiques;

    public function __construct()
    {
        $this->critiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFilm(): ?string
    {
        return $this->nom_film;
    }

    public function setNomFilm(string $nom_film): self
    {
        $this->nom_film = $nom_film;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|Critique[]
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): self
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques[] = $critique;
            $critique->setFilm($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): self
    {
        if ($this->critiques->contains($critique)) {
            $this->critiques->removeElement($critique);
            // set the owning side to null (unless already changed)
            if ($critique->getFilm() === $this) {
                $critique->setFilm(null);
            }
        }

        return $this;
    }
}
