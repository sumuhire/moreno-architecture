<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=36)
     * @Groups({"public"})
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Employee", inversedBy="projects")
     */
    private $projectManager;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $areaHorsSol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $areaSousSol;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $contractor;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image()
     */
    private $photo1;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image()
     */
    private $photo2;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image()
     */
    private $photo3;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image()
     */
    private $photo4;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image()
     */
    private $photo5;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="projects")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activity", inversedBy="projects")
     */
    private $Activities;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo6;

    public function __construct()
    {
        $this->projectManager = new ArrayCollection();
        $this->Activities = new ArrayCollection();
    }

    public function getId(): ?string
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

    /**
     * @return Collection|employee[]
     */
    public function getProjectManager(): Collection
    {
        return $this->projectManager;
    }

    public function addProjectManager(employee $projectManager): self
    {
        if (!$this->projectManager->contains($projectManager)) {
            $this->projectManager[] = $projectManager;
        }

        return $this;
    }

    public function removeProjectManager(employee $projectManager): self
    {
        if ($this->projectManager->contains($projectManager)) {
            $this->projectManager->removeElement($projectManager);
        }

        return $this;
    }

    public function getAreaHorsSol(): ?string
    {
        return $this->areaHorsSol;
    }

    public function setAreaHorsSol(?string $areaHorsSol): self
    {
        $this->areaHorsSol = $areaHorsSol;

        return $this;
    }

    public function getAreaSousSol(): ?string
    {
        return $this->areaSousSol;
    }

    public function setAreaSousSol(?string $areaSousSol): self
    {
        $this->areaSousSol = $areaSousSol;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getContractor(): ?string
    {
        return $this->contractor;
    }

    public function setContractor(?string $contractor): self
    {
        $this->contractor = $contractor;

        return $this;
    }

    public function getPhoto1(): ?string
    {
        return $this->photo1;
    }

    public function setPhoto1(string $photo1): self
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(string $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(string $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getPhoto4(): ?string
    {
        return $this->photo4;
    }

    public function setPhoto4(string $photo4): self
    {
        $this->photo4 = $photo4;

        return $this;
    }

    public function getPhoto5(): ?string
    {
        return $this->photo5;
    }

    public function setPhoto5(string $photo5): self
    {
        $this->photo5 = $photo5;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->Activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->Activities->contains($activity)) {
            $this->Activities[] = $activity;
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->Activities->contains($activity)) {
            $this->Activities->removeElement($activity);
        }

        return $this;
    }

    public function getPhoto6(): ?string
    {
        return $this->photo6;
    }

    public function setPhoto6(?string $photo6): self
    {
        $this->photo6 = $photo6;

        return $this;
    }

   
}
