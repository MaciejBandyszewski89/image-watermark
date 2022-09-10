<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\AppUser;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    public function registerAction(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $managerRegistry)
    {
        $user = new AppUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $email = $form->get('email')->getData();
            $user->setEmail($email);
            $password = $passwordHasher->hashPassword($user, $form->get('password')->getData());
            $user->setPassword($password);

            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_register');
        }

        return $this->render(
            'User/Registration/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
