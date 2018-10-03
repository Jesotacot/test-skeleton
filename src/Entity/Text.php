<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TextRepository")
 */
class Text
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
    private $idcomponent;

    /**
     * @ORM\Column(type="string", length=140)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdcomponent(): ?int
    {
        return $this->idcomponent;
    }

    public function setIdcomponent(int $idcomponent): self
    {
        $this->idcomponent = $idcomponent;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
