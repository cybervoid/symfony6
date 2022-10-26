<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'blog_list')]
    public function index(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {
        // ... e.g. get the user data from a registration form
        $user              = new User();
        $plaintextPassword = "rafa";
        $em                = $doctrine->getManager();

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);
        $user->setEmail("rgil@rectanglehealth.com");
        $em->persist($user);
        $em->flush($user);

        return $this->redirect("/");
    }
}