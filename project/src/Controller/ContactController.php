<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    public function __construct(private MailerInterface $mailer){}

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $email = (new TemplatedEmail())
                ->from($form->get('email')->getData())
                ->to('contact@monsite.com')
                ->subject( $form->get('subject')->getData())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'name' => $form->get('name')->getData(),
                    'mail' => $form->get('email')->getData(),
                    'number' => $form->get('number')->getData(),
                    'message' => $form->get('message')->getData(),
                ]);
            $this->mailer->send($email);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
