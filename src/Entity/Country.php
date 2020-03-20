<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stat", mappedBy="country", orphanRemoval=true)
     */
    private $stats;

    public function __construct()
    {
        $this->stats = new ArrayCollection();
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

    /**
     * @return Collection|Stat[]
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stat $stat): self
    {
        if (!$this->stats->contains($stat)) {
            $this->stats[] = $stat;
            $stat->setCountry($this);
        }

        return $this;
    }

    public function removeStat(Stat $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getCountry() === $this) {
                $stat->setCountry(null);
            }
        }

        return $this;
    }
    public function contaminated()
    {
        $somme = 0;

        foreach ($this->getStats() as $contaminated) {
            $somme += $contaminated->getContaminated();
        }
        return $somme;
    }

    public function healed()
    {
        $somme = 0;

        foreach ($this->getStats() as $healed) {
            $somme += $healed->getHealed();
        }
        return $somme;
    }

    public function zombified()
    {
        $somme = 0;

        foreach ($this->getStats() as $zombified) {
            $somme += $zombified->getZombified();
        }
        return $somme;
    }

    public function green()
    {

        if ($this->healed() > $this->contaminated()){
            return "ok";
        }
        else{
            return "zob";
        }
    }
}
