<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route([
        'fr' =>'/',
        'en' => '/en',
        'ru' => '/ru'
    ], name: 'app_main')]
    public function index(Request $request): Response
    {
        return $this->render('main/index.html.twig');
    }
}
