<?php

namespace App\Controller\Utilisateur;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('utilisateur/profile', name: 'profile_')]
#[IsGranted('ROLE_USER', message: 'Vous devez être connecté pour accéder à cette page')]
class ProfileUserController extends AbstractController
{
    #[Route('/', name: 'user', methods: ['GET'])]

    public function index(): Response
    {
        return $this->render('utilisateur/profile/index.html.twig', [
            'profile' => $this->getUser()
        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function edit(): Response
    {
        return $this->render('utilisateur/profile/edit.html.twig');
    }








}
