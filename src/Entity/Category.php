<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="category")
     */
    private $projects;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     */
    private $photo1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     */
    private $photo2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     */
    private $photo3;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
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

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setCategory($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getCategory() === $this) {
                $project->setCategory(null);
            }
        }

        return $this;
    }

    public function getPhoto1(): ?Project
    {
        return $this->photo1;
    }

    public function setPhoto1(?Project $photo1): self
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?Project
    {
        return $this->photo2;
    }

    public function setPhoto2(?Project $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?Project
    {
        return $this->photo3;
    }

    public function setPhoto3(?Project $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }

}
