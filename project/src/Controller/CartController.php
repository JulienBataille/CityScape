<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Entity\Cart;
use App\Entity\Property;
use PharIo\Manifest\Url;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    #[Route('/cart-{id}', name: 'app_cart')]
    public function index($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_cart_show');
    }

    #[Route('/cart', name: 'app_cart_show')]
    public function show(SessionInterface $session, PropertyRepository $property): Response
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach($panier as $id => $quantity){
            $panierWithData[] = [
                'product' => $property->find($id),
                'quantity' => $quantity
            ];
        }
        $total = 0;
        foreach($panierWithData as $item){
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }  

    #[Route('/cart/delete-{id}', name: 'app_cart_delete')]
    public function delete($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_cart_show');
    }

    #[Route('/cart/payment-stripe', name: 'app_cart_stripe')]
    public function stripe(SessionInterface $session, PropertyRepository $property)
    {
        $stripeSK = $_ENV['STRIPE_SK'];
        Stripe::setApiKey( $stripeSK );


        $lineItems = [];

        foreach ($session->get('panier', []) as $id => $quantity) 
        {
            $lineItems[] = [
                'price_data' =>
                [
                    'currency' => 'eur',
                    'product_data' =>
                    [
                        'name' => $property->find($id)->getPropertyTitle(),
                    ],
                    'unit_amount' => $property->find($id)->getPrice() * 100,
                ],
                'quantity' => $quantity,
            ];
        }
        $pay = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'bancontact', 'giropay', 'ideal', 'p24', 'sofort', 'sepa_debit'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => 'https://127.0.0.1:8000/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->generateUrl('app_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($pay->url, 303);

    }

    #[Route('/success', name: 'app_success')]
    public function success(Request $request, SessionInterface $session, PropertyRepository $property, EntityManagerInterface $em)
    {
        $session_id = $request->query->get('session_id');
        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SK']);
        $session_stripe = $stripe->checkout->sessions->retrieve($session_id, []);
        $payment_intent = $stripe->paymentIntents->retrieve($session_stripe->payment_intent);
        $id_payment = $payment_intent->id;

        $panier = $session->get('panier', []);

        foreach($panier as $id => $quantity)
        {
            $cart = new Cart();
            $cart->setStripeId( $id_payment );
            $cart->setUser( $this->getUser());
            $cart->addProperty($property->find($id));
            $em->persist($cart);
            $em->flush();
        }

        return $this->render('cart/success.html.twig');
    }

    #[Route('/cancel', name: 'app_cancel')]
    public function cancel()
    {
        return $this->render('cart/cancel.html.twig');
    }
    
}