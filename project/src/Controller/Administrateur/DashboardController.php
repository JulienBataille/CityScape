<?php

namespace App\Controller\Administrateur;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/administrateur', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('administrateur/index.html.twig', []);

    }


}
