<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HomeController
{
    public function __construct(private Environment $twig)
    {
    }

    public function indexAction(): Response
    {
        return new Response($this->twig->render('index.html.twig'));
    }
}
