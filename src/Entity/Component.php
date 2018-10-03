<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Creative", inversedBy="component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creative;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Text", mappedBy="component")
     */
    private $text;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="component")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="component")
     */
    private $video;

    public function __construct()
    {
        $this->text = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreative(): ?Creative
    {
        return $this->creative;
    }

    public function setCreative(?Creative $creative): self
    {
        $this->creative = $creative;

        return $this;
    }

    /**
     * @return Collection|Text[]
     */
    public function getText(): Collection
    {
        return $this->text;
    }

    public function addText(Text $text): self
    {
        if (!$this->text->contains($text)) {
            $this->text[] = $text;
            $text->setComponent($this);
        }

        return $this;
    }

    public function removeText(Text $text): self
    {
        if ($this->text->contains($text)) {
            $this->text->removeElement($text);
            // set the owning side to null (unless already changed)
            if ($text->getComponent() === $this) {
                $text->setComponent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setComponent($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getComponent() === $this) {
                $image->setComponent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
            $video->setComponent($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->video->contains($video)) {
            $this->video->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getComponent() === $this) {
                $video->setComponent(null);
            }
        }

        return $this;
    }
}
