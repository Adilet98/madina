<?php

namespace App\Controller;

use App\Entity\ClassGroup;
use App\Entity\Schedule;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Form\ProgressFormType;
use App\Form\ScheduleType;
use App\Form\StudentType;
use App\Form\TeacherType;
use App\Repository\ClassGroupRepository;
use App\Repository\ScheduleRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->redirectToRoute('admin_teacher_index');
    }

    /**
     * @Route("/admin/teachers", name="admin_teacher_index", methods={"GET"})
     */
    public function teachers(TeacherRepository $teacherRepository): Response
    {
        return $this->render('admin/adminbody/admin_teacher/teachers.html.twig', [
            'teachers' => $teacherRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/teachers/new", name="teacher_new", methods={"GET","POST"})
     */
    public function newTeacher(Request $request): Response
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($teacher);
            $entityManager->flush();

            return $this->redirectToRoute('admin_teacher_index');
        }

        return $this->render('admin/adminbody/admin_teacher/new.html.twig', [
            'teacher' => $teacher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/teachers/show/{id}", name="teacher_show", methods={"GET"})
     */
    public function showTeacher(Teacher $teacher): Response
    {
        return $this->render('admin/adminbody/admin_teacher/show.html.twig', [
            'teacher' => $teacher,
        ]);
    }

    /**
     * @Route("/admin/teachers/edit/{id}", name="teacher_edit", methods={"GET","POST"})
     */
    public function editTeacher(Request $request, Teacher $teacher): Response
    {
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_teacher_index');
        }

        return $this->render('admin/adminbody/admin_teacher/edit.html.twig', [
            'teacher' => $teacher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/teachaers/delete/{id}", name="teacher_delete", methods={"DELETE"})
     */
    public function deleteTeacher(Request $request, Teacher $teacher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teacher->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($teacher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_teacher_index');
    }

    /**
     * @Route("/admin/students", name="admin_student_index", methods={"GET"})
     */
    public function students(StudentRepository $studentRepository): Response
    {
        return $this->render('admin/adminbody/admin_student/students.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/students/new", name="student_new", methods={"GET","POST"})
     */
    public function newStudent(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('admin_student_index');
        }

        return $this->render('admin/adminbody/admin_student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/students/show/{id}", name="student_show", methods={"GET"})
     */
    public function showStudent(Student $student): Response
    {
        return $this->render('admin/adminbody/admin_student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/admin/students/edit/{id}", name="student_edit", methods={"GET","POST"})
     */
    public function editStudent(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_student_index');
        }

        return $this->render('admin/adminbody/admin_student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/students/delete/{id}", name="student_delete", methods={"DELETE"})
     */
    public function deleteStudent(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_student_index');
    }

    /**
     * @Route("/admin/groups", name="admin_groups_index", methods={"GET"})
     */
    public function groups(ClassGroupRepository $classGroupRepository): Response
    {
        return $this->render('admin/adminbody/admin_groups/groups.html.twig', [
            'classGroups' => $classGroupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/groups/{id}/progress", name="group_progress_list", methods={"GET"})
     */
    public function groupStudentsProgress(StudentRepository $studentRepository, int $id): Response
    {
        return $this->render('admin/adminbody/admin_progress/group_students.html.twig', [
            'groupStudents' => $studentRepository->findByGroup($id),
        ]);
    }

    /**
     * @Route("/admin/student/progress/{id}/edit", name="student_progress_edit", methods={"GET", "POST"})
     */
    public function progressEdit(Request $request, StudentRepository $studentRepository, int $id): Response
    {
        $student = $studentRepository->find($id);

        $form = $this->createForm(ProgressFormType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_progress_list', [
                'id' => $student->getGroupName()->getId()
            ]);
        }

        return $this->render('admin/adminbody/admin_progress/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/schedule/groups", name="schedule_groups_index", methods={"GET"})
     */
    public function scheduleGroups(ClassGroupRepository $classGroupRepository): Response
    {
        return $this->render('admin/adminbody/admin_schedule/groups.html.twig', [
            'classGroups' => $classGroupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/group/{groupId}/schedule", name="admin_schedule_index", methods={"GET"})
     */
    public function schedule(ScheduleRepository $scheduleRepository, int $groupId): Response
    {
        $group = $this->getDoctrine()
            ->getRepository(ClassGroup::class)
            ->find($groupId);

        $schedules = $scheduleRepository->findBy(['classGroup' => $group]);

        return $this->render('admin/adminbody/admin_schedule/schedule.html.twig', [
            'schedules' => $schedules
        ]);
    }

    /**
     * @Route("/admin/schedule/create", name="schedule_create", methods={"GET", "POST"})
     */
    public function scheduleCreate(Request $request, ScheduleRepository $scheduleRepository): Response
    {
        $schedule = new Schedule();

        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($schedule);
            $entityManager->flush();

            return $this->redirectToRoute('admin_schedule_index', [
                'groupId' => $schedule->getClassGroup()->getId()
            ]);
        }

        return $this->render('admin/adminbody/admin_schedule/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/schedule/{groupId}/edit/{id}", name="schedule_edit", methods={"GET", "POST"})
     */
    public function scheduleEdit(Request $request, ScheduleRepository $scheduleRepository, int $id, int $groupId): Response
    {
        $schedule = $scheduleRepository->find($id);

        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_schedule_index', [
                'groupId' => $groupId
            ]);
        }

        return $this->render('admin/adminbody/admin_schedule/edit.html.twig', [
            'groupId' => $groupId,
            'form' => $form->createView(),
        ]);
    }
}
