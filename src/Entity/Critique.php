<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CritiqueRepository")
 * @ORM\HasLifecycleCallbacks()
 * //Pour une date de creation
 */
class Critique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $texte_critique;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Films", inversedBy="critiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexteCritique(): ?string
    {
        return $this->texte_critique;
    }

    public function setTexteCritique(string $texte_critique): self
    {
        $this->texte_critique = $texte_critique;

        return $this;
    }

    public function getNameUser(): ?string
    {
        return $this->name_user;
    }

    public function setNameUser(string $name_user): self
    {
        $this->name_user = $name_user;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @throws \Exception
     * @ORM\PrePersist()
     * //Sert à créer une date de création automatiquement avant la mise en BDD
     */
    public function preCreateAt(){

        if($this->create_at == null)
        {
            $this->create_at = new \DateTime();
        }
    }

    public function getFilm(): ?Films
    {
        return $this->film;
    }

    public function setFilm(?Films $film): self
    {
        $this->film = $film;

        return $this;
    }
}
