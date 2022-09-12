<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    public function indexAction(#[CurrentUser] ?User $user): Response
    {
        if (null === $user){
            return $this->json([
                'message' => 'missing credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = random_bytes(40);

        return $this->json([
            'user' => $user->getUserIdentifier,
            'token' => $token,
        ]);
    }
}
