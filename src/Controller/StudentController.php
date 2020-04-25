<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(StudentRepository $studentRepository)
    {
        return $this->render('student/studentbody/student_data/show.html.twig', [
            'student' => $studentRepository->findOneBy(['user' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/student/schedule", name="student_schedule_index", methods={"GET"})
     */
    public function schedule(StudentRepository $studentRepository, ScheduleRepository $scheduleRepository): Response
    {
        $group = $studentRepository->findOneBy([
            'user' => $this->getUser()
        ])->getGroupName();

        $schedules = $scheduleRepository->findBy(['classGroup' => $group]);

        return $this->render('student/studentbody/student_schedule/schedule.html.twig', [
            'schedules' => $schedules
        ]);
    }

    /**
     * @Route("/student/progress", name="student_progress", methods={"GET"})
     */
    public function studentProgress(StudentRepository $studentRepository): Response
    {
        $student = $studentRepository->findOneBy([
            'user' => $this->getUser()
        ]);

        return $this->render('student/studentbody/student_progress/student.html.twig', [
            'student' => $student,
        ]);
    }
}
