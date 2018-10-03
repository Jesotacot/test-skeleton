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
     * @ORM\Column(type="string", length=140)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component", inversedBy="text")
     * @ORM\JoinColumn(nullable=false)
     */
    private $component;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    public function setComponent(?Component $component): self
    {
        $this->component = $component;

        return $this;
    }
}
