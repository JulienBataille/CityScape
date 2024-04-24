<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use libphonenumber\PhoneNumberUtil;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    #[Route([
        'fr' =>'/contact',
        'en' => '/en/contact',
        'ru' => '/ru/contact'
    ], name: 'app_contact')]
    public function index(Request $request): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $local = strtoupper($request->getLocale());
            $numberStr = $form->get('number')->getData();
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();

            try {
                $swissNumberProto = $phoneUtil->parse($numberStr, $local);
                $a = $phoneUtil->format($swissNumberProto, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
                $geocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
                $b = $geocoder->getDescriptionForNumber($swissNumberProto, "en_US");
                var_dump($b);
            } catch (\libphonenumber\NumberParseException $e) {
                var_dump($e);
            }
            $email = (new TemplatedEmail())
                ->from($form->get('email')->getData())
                ->to('contact@monsite.com')
                ->subject($form->get('subject')->getData())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'name' => $form->get('name')->getData(),
                    'mail' => $form->get('email')->getData(),
                    'number' => $a,
                    'message' => $form->get('message')->getData(),
                ]);
            $this->mailer->send($email);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
