<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
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
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JobProfile", mappedBy="job", cascade={"persist"})
     */
    private $profils;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JobMission", mappedBy="job", cascade={"persist"})
     */
    private $Missions;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
        $this->Missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|JobProfile[]
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(JobProfile $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
            $profil->setJob($this);
        }

        return $this;
    }

    public function removeProfil(JobProfile $profil): self
    {
        if ($this->profils->contains($profil)) {
            $this->profils->removeElement($profil);
            // set the owning side to null (unless already changed)
            if ($profil->getJob() === $this) {
                $profil->setJob(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JobMission[]
     */
    public function getMissions(): Collection
    {
        return $this->Missions;
    }

    public function addMission(JobMission $mission): self
    {
        if (!$this->Missions->contains($mission)) {
            $this->Missions[] = $mission;
            $mission->setJob($this);
        }

        return $this;
    }

    public function removeMission(JobMission $mission): self
    {
        if ($this->Missions->contains($mission)) {
            $this->Missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getJob() === $this) {
                $mission->setJob(null);
            }
        }

        return $this;
    }
}
