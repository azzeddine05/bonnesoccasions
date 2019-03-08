<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorie",mappedBy="category" , cascade={"persist","remove"})
     */
    protected $sousCategorie;

    public function __construct()
    {
        $this->sousCategorie = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sousCategorie;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie[] = $sousCategorie;
            $sousCategorie->setCategory($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie->removeElement($sousCategorie);
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getCategory() === $this) {
                $sousCategorie->setCategory(null);
            }
        }

        return $this;
    }
}
