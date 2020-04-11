<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Teacher;
use App\Form\StudentType;
use App\Form\TeacherType;
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
        return $this->redirectToRoute('teacher_index');
    }

    /**
     * @Route("/admin/teachers", name="teacher_index", methods={"GET"})
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

            return $this->redirectToRoute('teacher_index');
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

            return $this->redirectToRoute('teacher_index');
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

        return $this->redirectToRoute('teacher_index');
    }

    /**
     * @Route("/admin/students", name="student_index", methods={"GET"})
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

            return $this->redirectToRoute('student_index');
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

            return $this->redirectToRoute('student_index');
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

        return $this->redirectToRoute('student_index');
    }
}
