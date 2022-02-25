<?php

namespace App\Entity;

use App\Repository\EntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=EntrainementRepository::class)
 */
class Entrainement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Jeux::class, cascade={"persist", "remove"})
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="le champ est vide")
     */
    private $titre;

    public function __toString()
    {
       return(string)$this->getTitre();
    }

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="le champ est vide")
     */
    private $videotuto;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="le champ est vide")
     */
    private $descriptiontuto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?Jeux $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getVideotuto(): ?string
    {
        return $this->videotuto;
    }

    public function setVideotuto(string $videotuto): self
    {
        $this->videotuto = $videotuto;

        return $this;
    }

    public function getDescriptiontuto(): ?string
    {
        return $this->descriptiontuto;
    }

    public function setDescriptiontuto(string $descriptiontuto): self
    {
        $this->descriptiontuto = $descriptiontuto;

        return $this;
    }
}
