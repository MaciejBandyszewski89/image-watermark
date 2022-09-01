<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function indexAction(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('User/Profile/index.html.twig', [
            'users' => $users
        ]);
    }
}
