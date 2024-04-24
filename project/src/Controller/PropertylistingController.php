<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PropertylistingController extends AbstractController
{
    #[Route(['fr'=>'/{category}/{souscategory}.html',
            'en'=>'/{category}/{souscategory}.html',                   
            'ru'=>'/{category}/{souscategory}.html'],
            name: 'propertylisting')]
    public function index($souscategory, $category, PropertyRepository $property, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $property->findPropertyByCategory( $souscategory,$category);
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        return $this->render('property/listing.html.twig', ['properties' => $pagination]);
    }
}

