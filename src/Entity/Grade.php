<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 */
class Grade
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
