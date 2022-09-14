<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    public function loginAction(AuthenticationUtils $authenticationUnits): Response
    {
     $error = $authenticationUnits->getLastAuthenticationError();

     $lastUsername = $authenticationUnits->getLastUsername();

     return $this->render('User/Login/login.html.twig', [
         'last_username' => $lastUsername,
         'error'         => $error,
     ]);
    }
}
