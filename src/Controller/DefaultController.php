<?php

namespace App\Controller;

use App\DBAL\Types\RoleEnumType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('redirectRoute');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('default/index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/redirect", name="redirectRoute")
     */
    public function redirectRoute()
    {
        if ($this->isGranted(RoleEnumType::ROLE_ADMIN)) {
            return $this->redirectToRoute('admin');
        }

        if ($this->isGranted(RoleEnumType::ROLE_TEACHER)) {
            return $this->redirectToRoute('teacher');
        }

        if ($this->isGranted(RoleEnumType::ROLE_STUDENT)) {
            return $this->redirectToRoute('student');
        }
    }

    /**
     * @Route("/author", name="author")
     */
    public function author()
    {
        return $this->render('info/author.html.twig');
    }

    /**
     * @Route("/service", name="service")
     */
    public function service()
    {
        return $this->render('info/service.html.twig');
    }
}
