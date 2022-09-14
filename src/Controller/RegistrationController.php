<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    public function registerAction(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $managerRegistry)
    {
        $user = new User();
        $form = $this->createForm(RegisterUserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setEmail($form->get('email')->getData());
            $password = $passwordHasher->hashPassword($user, $form->get('password')->getData());
            $user->setPassword($password);

            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Congrats.');

            return $this->redirectToRoute('user_register');
        }

        return $this->render(
            'User/Registration/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
