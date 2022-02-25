<?php

namespace App\Entity;
use App\Repository\JeuxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=JeuxRepository::class)
 */
class Jeux
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
    private $titre;

    public function __toString()
    {
        return(string)$this->getTitre();
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lientelechargement;

    /**
     * @ORM\Column(type="float")
     */
    private $agemin;

    /**
     * @ORM\Column(type="float")
     * @Assert\GreaterThan(18)
     */
    private $agemax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLientelechargement(): ?string
    {
        return $this->lientelechargement;
    }

    public function setLientelechargement(string $lientelechargement): self
    {
        $this->lientelechargement = $lientelechargement;

        return $this;
    }

    public function getAgemin(): ?float
    {
        return $this->agemin;
    }

    public function setAgemin(float $agemin): self
    {
        $this->agemin = $agemin;

        return $this;
    }

    public function getAgemax(): ?float
    {
        return $this->agemax;
    }

    public function setAgemax(float $agemax): self
    {
        $this->agemax = $agemax;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(string $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}
