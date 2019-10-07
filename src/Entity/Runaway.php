<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RunawayRepository")
 */
class Runaway
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getProject1(): ?Project
    {
        return $this->project1;
    }

    public function setProject1(Project $project1): self
    {
        $this->project1 = $project1;

        return $this;
    }

    public function getProject2(): ?Project
    {
        return $this->project2;
    }

    public function setProject2(Project $project2): self
    {
        $this->project2 = $project2;

        return $this;
    }

    public function getProject3(): ?Project
    {
        return $this->project3;
    }

    public function setProject3(Project $project3): self
    {
        $this->project3 = $project3;

        return $this;
    }
}
