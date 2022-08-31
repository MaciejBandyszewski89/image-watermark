<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    public function registerAction(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $managerRegistry)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordHasher->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_register');
        }

        return $this->render(
            'registration/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
