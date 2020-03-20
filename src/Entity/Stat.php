<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatRepository")
 */
class Stat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contaminated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $healed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zombified;

    /**
     * @ORM\Column(type="datetime")
     */
    private $statDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContaminated(): ?string
    {
        return $this->contaminated;
    }

    public function setContaminated(?string $contaminated): self
    {
        $this->contaminated = $contaminated;

        return $this;
    }

    public function getHealed(): ?string
    {
        return $this->healed;
    }

    public function setHealed(?string $healed): self
    {
        $this->healed = $healed;

        return $this;
    }

    public function getZombified(): ?string
    {
        return $this->zombified;
    }

    public function setZombified(?string $zombified): self
    {
        $this->zombified = $zombified;

        return $this;
    }

    public function getStatDate(): ?\DateTimeInterface
    {
        return $this->statDate;
    }

    public function setStatDate(\DateTimeInterface $statDate): self
    {
        $this->statDate = $statDate;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function __construct()
    {
        $this->setStatDate(new \DateTime());
    }
}
