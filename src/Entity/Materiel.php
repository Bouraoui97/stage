<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datedacquisition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $affectation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Unite::class, inversedBy="materiels")
     */
    private $unite;

    /**
     * @ORM\ManyToOne(targetEntity=Piecesderechange::class, inversedBy="materiels")
     */
    private $piecesderechange;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="materiels")
     */
    private $inventaire;

    /**
     * @ORM\OneToMany(targetEntity=Intervention::class, mappedBy="materiel")
     */
    private $intervention;

    public function __construct()
    {
        $this->intervention = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatedacquisition(): ?string
    {
        return $this->datedacquisition;
    }

    public function setDatedacquisition(string $datedacquisition): self
    {
        $this->datedacquisition = $datedacquisition;

        return $this;
    }

    public function getAffectation(): ?string
    {
        return $this->affectation;
    }

    public function setAffectation(string $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    public function getPiecesderechange(): ?Piecesderechange
    {
        return $this->piecesderechange;
    }

    public function setPiecesderechange(?Piecesderechange $piecesderechange): self
    {
        $this->piecesderechange = $piecesderechange;

        return $this;
    }

    public function getInventaire(): ?Inventaire
    {
        return $this->inventaire;
    }

    public function setInventaire(?Inventaire $inventaire): self
    {
        $this->inventaire = $inventaire;

        return $this;
    }

    /**
     * @return Collection|Intervention[]
     */
    public function getIntervention(): Collection
    {
        return $this->intervention;
    }

    public function addIntervention(Intervention $intervention): self
    {
        if (!$this->intervention->contains($intervention)) {
            $this->intervention[] = $intervention;
            $intervention->setMateriel($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->intervention->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getMateriel() === $this) {
                $intervention->setMateriel(null);
            }
        }

        return $this;
    }


}
