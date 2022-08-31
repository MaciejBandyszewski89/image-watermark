<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ImageUploadFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ImageController extends AbstractController
{
    public function __construct(private Environment $twig)
    {
    }

    public function indexAction(): Response
    {
        $form = $this->createForm(ImageUploadFormType::class, null, [
            'action' => $this->generateUrl('upload'),
            'method' => 'POST'
        ]);

        return new Response(
            $this->twig->render(
                'Image/index.html.twig',
                [
                    'form' => $form->createView()
                ]
            )
        );
    }

    public function uploadAction(Request $request): Response
    {
        $form = $this->createForm(ImageUploadFormType::class);

        return new Response(
            $this->twig->render(
                'Image/index.html.twig',
                [
                    'form' => $form->createView()
                ]
            )
        );
    }
}
