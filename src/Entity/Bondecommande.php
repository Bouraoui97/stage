<?php

namespace App\Entity;

use App\Repository\BondecommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BondecommandeRepository::class)
 */
class Bondecommande
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
    private $num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nmbmt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getNmbmt(): ?string
    {
        return $this->nmbmt;
    }

    public function setNmbmt(string $nmbmt): self
    {
        $this->nmbmt = $nmbmt;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
