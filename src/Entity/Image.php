<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2083)
     * @Assert\Length(
     *      min = 1,
     *      max = 2083,
     *      minMessage = "Your url must have at least 1 character",
     *      maxMessage = "Your url can not be greater than 2083 characters"
     * )
     * @Assert\NotBlank()
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(
     *        choices = {"JPG", "PNG"},
     *        message = "Choose a valid format [JPG,PNG]"
     * )
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="The value weight is not valid integer"
     * )
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component", inversedBy="image")
     * @ORM\JoinColumn(nullable=false)
     */
    private $component;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

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
