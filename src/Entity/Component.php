<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComponentRepository")
 */
class Component
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcreative;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $posx;

    /**
     * @ORM\Column(type="integer")
     */
    private $posy;

    /**
     * @ORM\Column(type="integer")
     */
    private $posz;

    /**
     * @ORM\Column(type="integer")
     */
    private $width;

    /**
     * @ORM\Column(type="integer")
     */
    private $high;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdcreative(): ?int
    {
        return $this->idcreative;
    }

    public function setIdcreative(int $idcreative): self
    {
        $this->idcreative = $idcreative;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosx(): ?int
    {
        return $this->posx;
    }

    public function setPosx(int $posx): self
    {
        $this->posx = $posx;

        return $this;
    }

    public function getPosy(): ?int
    {
        return $this->posy;
    }

    public function setPosy(int $posy): self
    {
        $this->posy = $posy;

        return $this;
    }

    public function getPosz(): ?int
    {
        return $this->posz;
    }

    public function setPosz(int $posz): self
    {
        $this->posz = $posz;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHigh(): ?int
    {
        return $this->high;
    }

    public function setHigh(int $high): self
    {
        $this->high = $high;

        return $this;
    }
}
