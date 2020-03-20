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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contaminated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $healed;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    public function getContaminated(): ?int
    {
        return $this->contaminated;
    }

    public function setContaminated(?int $contaminated): self
    {
        $this->contaminated = $contaminated;

        return $this;
    }

    public function getHealed(): ?int
    {
        return $this->healed;
    }

    public function setHealed(?int $healed): self
    {
        $this->healed = $healed;

        return $this;
    }

    public function getZombified(): ?int
    {
        return $this->zombified;
    }

    public function setZombified(?int $zombified): self
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
