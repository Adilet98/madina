<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 */
class Teacher
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
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="teacher")
     */
    private $schedules;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClassGroup", inversedBy="teachers")
     */
    private $groupNames;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plan", mappedBy="teacher", orphanRemoval=true)
     */
    private $plans;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->groupNames = new ArrayCollection();
        $this->plans = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->surname . ' ' . $this->firstname . ' ' . $this->lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitials(): ?string
    {
        return mb_substr($this->firstname, 0, 1) . '. ' . mb_substr($this->lastname, 0, 1) . '.';
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setTeacher($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getTeacher() === $this) {
                $schedule->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClassGroup[]
     */
    public function getGroupNames(): Collection
    {
        return $this->groupNames;
    }

    public function addGroupName(ClassGroup $groupName): self
    {
        if (!$this->groupNames->contains($groupName)) {
            $this->groupNames[] = $groupName;
        }

        return $this;
    }

    public function removeGroupName(ClassGroup $groupName): self
    {
        if ($this->groupNames->contains($groupName)) {
            $this->groupNames->removeElement($groupName);
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setTeacher($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->contains($plan)) {
            $this->plans->removeElement($plan);
            // set the owning side to null (unless already changed)
            if ($plan->getTeacher() === $this) {
                $plan->setTeacher(null);
            }
        }

        return $this;
    }
}
