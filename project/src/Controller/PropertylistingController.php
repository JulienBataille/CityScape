<?php

namespace App\Controller;

use App\Entity\Newsletters\Newsletters;
use App\Form\NewslettersType;
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
    public function index($souscategory, $category, PropertyRepository $property, PaginatorInterface $paginator, Request $request, ): Response
    {
        $query = $property->findPropertyByCategory( $souscategory,$category);
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        $newsletters = new Newsletters();
        $form = $this->createForm(NewslettersType::class, $newsletters, [
            'method' => 'POST', //possibilité d'insérer class et ID avec 'attr'
        ]);
        $form->handleRequest($request);

        return $this->render('property/listing.html.twig',
         ['properties' => $pagination,
         'form' => $form->createView()
        ]);
    }
}
