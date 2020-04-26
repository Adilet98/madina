<?php

namespace App\Controller;

use App\Entity\ClassGroup;
use App\Entity\Grade;
use App\Entity\Plan;
use App\Form\PlanType;
use App\Form\ProgressFormType;
use App\Repository\ClassGroupRepository;
use App\Repository\GradeRepository;
use App\Repository\PlanRepository;
use App\Repository\ScheduleRepository;
use App\Repository\StudentRepository;
use App\Repository\SubjectRepository;
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
     * @Route("/teacher/group/{id}/students", name="teacher_group_students", methods={"GET"})
     */
    public function studentList(ClassGroupRepository $classGroupRepository, int $id): Response
    {
        $students = $classGroupRepository->find($id)->getStudents();

        return $this->render('teacher/teacherbody/teacher_progress/student_list.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/teacher/student/progress/{id}", name="teacher_student_progress", methods={"GET"})
     */
    public function groupStudentProgress(StudentRepository $studentRepository, SubjectRepository $subjectRepository, int $id): Response
    {
        $student = $studentRepository->find($id);
        $subjects = $subjectRepository->findAll();

        return $this->render('teacher/teacherbody/teacher_progress/group_students.html.twig', [
            'student' => $student,
            'subjects' => $subjects,
            'id' => $id
        ]);
    }

    /**
     * @Route("/teacher/student/{id}/progress/create", name="teacher_student_progress_create", methods={"GET", "POST"})
     */
    public function progressCreate(Request $request, StudentRepository $studentRepository, int $id): Response
    {
        $grade = new Grade();

        $form = $this->createForm(ProgressFormType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grade);
            $entityManager->flush();

            return $this->redirectToRoute('teacher_student_progress', [
                'id' => $id
            ]);
        }

        return $this->render('teacher/teacherbody/teacher_progress/edit.html.twig', [
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/teacher/student/progress/{id}/edit", name="teacher_student_progress_edit", methods={"GET", "POST"})
     */
    public function progressEdit(Request $request, GradeRepository $gradeRepository, int $id): Response
    {
        $grade = $gradeRepository->find($id);
        $student = $grade->getStudent();

        $form = $this->createForm(ProgressFormType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_student_progress', [
                'id' => $student->getId()
            ]);
        }

        return $this->render('teacher/teacherbody/teacher_progress/edit.html.twig', [
            'id' => $student->getId(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/teacher/plan", name="teacher_plan")
     */
    public function plan(TeacherRepository $teacherRepository)
    {
        return $this->render('teacher/teacherbody/teacher_plan/show.html.twig', [
            'plans' => $teacherRepository->findOneBy(['user' => $this->getUser()])->getPlans()
        ]);
    }

    /**
     * @Route("/teacher/plan/create", name="teacher_plan_create")
     */
    public function planCreate(Request $request, TeacherRepository $teacherRepository)
    {
        $plan = new Plan();
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plan);
            $entityManager->flush();

            return $this->redirectToRoute('teacher_plan');
        }

        return $this->render('teacher/teacherbody/teacher_plan/edit.html.twig', [
            'id' => null,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/teacher/plan/edit/{id}", name="teacher_plan_edit")
     */
    public function planEdit(Request $request, PlanRepository $planRepository, int $id)
    {
        $plan = $planRepository->find($id);

        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_plan');
        }

        return $this->render('teacher/teacherbody/teacher_plan/edit.html.twig', [
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/teacher/plan/delete/{id}", name="teacher_plan_delete")
     */
    public function planDelete(PlanRepository $planRepository, int $id): Response
    {
        $plan = $planRepository->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($plan);
        $entityManager->flush();

        return $this->redirectToRoute('teacher_plan');
    }
}
