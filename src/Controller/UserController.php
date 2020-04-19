<?php

namespace App\Controller;

use App\DBAL\Types\RoleEnumType;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/admin/users", name="user_index", methods={"GET"})
     */
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        $roles = [];
        foreach ($users as $user) {
            $roles[] = array_keys(array_intersect(RoleEnumType::getChoices(), $user->getRoles()));
        }

        return $this->render('admin/adminbody/admin_user/users.html.twig', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * @Route("/admin/users/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $password
            ));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/adminbody/admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/users/show/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/adminbody/admin_user/show.html.twig', [
            'user' => $user,
            'roles' => array_keys(array_intersect(RoleEnumType::getChoices(), $user->getRoles()))
        ]);
    }

    /**
     * @Route("/admin/users/edit/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $password
            ));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/adminbody/admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/delete/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
