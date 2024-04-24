<?php
namespace App\Controller\Google;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends AbstractController
{

    #[Route('/connect/google', name:'connect_google_start')]
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('google_main')
            ->redirect([
                'public_profile','email'
            ])
            ;
    }


    #[Route('/connect/google/check', name:'connect_google_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        $client = $clientRegistry->getClient('google_main');

        try {
            $user = $client->fetchUser();
            var_dump($user); die;
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage()); die;
        }
    }
}