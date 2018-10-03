<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreativeRepository")
 */
class Creative
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
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Component", mappedBy="creative")
     */
    private $component;

    public function __construct()
    {
        $this->component = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Component[]
     */
    public function getComponent(): Collection
    {
        return $this->component;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->component->contains($component)) {
            $this->component[] = $component;
            $component->setCreative($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->component->contains($component)) {
            $this->component->removeElement($component);
            // set the owning side to null (unless already changed)
            if ($component->getCreative() === $this) {
                $component->setCreative(null);
            }
        }

        return $this;
    }
}
