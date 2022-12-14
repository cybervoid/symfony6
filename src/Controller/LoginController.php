<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/', name: 'app_entry')]
    public function index()
    {
        return $this->render("body.html.twig");
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @return Response
     */
    #[Route('/protected', name: 'app_protected')]
    public function protectedEndpoint(): Response
    {
        return $this->render("body.html.twig");
    }

    #[Route('/protected1', name: 'app_second_protected')]
    public function secondProtectedEndpoint(): Response
    {
        return $this->render("body.html.twig");
    }
}
