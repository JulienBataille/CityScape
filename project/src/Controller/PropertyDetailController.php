<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyDetailController extends AbstractController
{
    #[Route('/property/detail/{slug}', name: 'app_property_detail')]
    public function index(Property $property): Response
    {
        return $this->render('property_detail/index.html.twig',[
            'property' => $property,
        ]);
    }
}
