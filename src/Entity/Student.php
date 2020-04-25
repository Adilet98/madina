<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shift;

    /**
     * @ORM\Column(type="date")
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="ClassGroup", inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quarterOne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quarterTwo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quarterThree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quarterFour;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exam;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $final;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getShift(): ?string
    {
        return $this->shift;
    }

    public function setShift(string $shift): self
    {
        $this->shift = $shift;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGroupName(): ?ClassGroup
    {
        return $this->groupName;
    }

    public function setGroupName(?ClassGroup $groupName): self
    {
        $this->groupName = $groupName;

        return $this;
    }

    public function getQuarterOne(): ?int
    {
        return $this->quarterOne;
    }

    public function setQuarterOne(?int $quarterOne): self
    {
        $this->quarterOne = $quarterOne;

        return $this;
    }

    public function getQuarterTwo(): ?int
    {
        return $this->quarterTwo;
    }

    public function setQuarterTwo(?int $quarterTwo): self
    {
        $this->quarterTwo = $quarterTwo;

        return $this;
    }

    public function getQuarterThree(): ?int
    {
        return $this->quarterThree;
    }

    public function setQuarterThree(?int $quarterThree): self
    {
        $this->quarterThree = $quarterThree;

        return $this;
    }

    public function getQuarterFour(): ?int
    {
        return $this->quarterFour;
    }

    public function setQuarterFour(?int $quarterFour): self
    {
        $this->quarterFour = $quarterFour;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getExam(): ?int
    {
        return $this->exam;
    }

    public function setExam(?int $exam): self
    {
        $this->exam = $exam;

        return $this;
    }

    public function getFinal(): ?int
    {
        return $this->final;
    }

    public function setFinal(?int $final): self
    {
        $this->final = $final;

        return $this;
    }
}
