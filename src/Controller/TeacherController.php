<?php

namespace App\Controller;

use App\Entity\ClassGroup;
use App\Form\ProgressFormType;
use App\Repository\ClassGroupRepository;
use App\Repository\ScheduleRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="teacher")
     */
    public function index(TeacherRepository $teacherRepository)
    {
        return $this->render('teacher/teacherbody/teacher_data/show.html.twig', [
            'teacher' => $teacherRepository->findOneBy(['user' => $this->getUser()])
        ]);
    }

    /**
     * @Route("/teacher/schedule/groups", name="teacher_shedule_groups", methods={"GET"})
     */
    public function scheduleGroups(TeacherRepository $teacherRepository): Response
    {
        $groups = $teacherRepository->findOneBy(['user' => $this->getUser()])
            ->getGroupNames();

        return $this->render('teacher/teacherbody/teacher_schedule/groups.html.twig', [
            'classGroups' => $groups,
        ]);
    }

    /**
     * @Route("/teacher/group/{groupId}/schedule", name="teacher_schedule_index", methods={"GET"})
     */
    public function schedule(ScheduleRepository $scheduleRepository, int $groupId): Response
    {
        $group = $this->getDoctrine()
            ->getRepository(ClassGroup::class)
            ->find($groupId);

        $schedules = $scheduleRepository->findBy(['classGroup' => $group]);

        return $this->render('teacher/teacherbody/teacher_schedule/schedule.html.twig', [
            'schedules' => $schedules
        ]);
    }

    /**
     * @Route("/teacher/progress/groups", name="teacher_progress_groups", methods={"GET"})
     */
    public function progressGroups(TeacherRepository $teacherRepository): Response
    {
        $groups = $teacherRepository->findOneBy(['user' => $this->getUser()])
            ->getGroupNames();

        return $this->render('teacher/teacherbody/teacher_progress/groups.html.twig', [
            'classGroups' => $groups,
        ]);
    }

    /**
     * @Route("/teacher/groups/{groupId}/progress", name="teacher_group_progress", methods={"GET"})
     */
    public function groupStudentsProgress(StudentRepository $studentRepository, int $groupId): Response
    {
        return $this->render('teacher/teacherbody/teacher_progress/group_students.html.twig', [
            'groupStudents' => $studentRepository->findByGroup($groupId),
        ]);
    }

    /**
     * @Route("/teacher/student/progress/{id}/edit", name="teacher_progress_edit", methods={"GET", "POST"})
     */
    public function progressEdit(Request $request, StudentRepository $studentRepository, int $id): Response
    {
        $student = $studentRepository->find($id);

        $form = $this->createForm(ProgressFormType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_group_progress', [
                'groupId' => $student->getGroupName()->getId()
            ]);
        }

        return $this->render('teacher/teacherbody/teacher_progress/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }
}
