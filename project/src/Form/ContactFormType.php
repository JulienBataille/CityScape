<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' =>
                        [
                            'placeholder' => 'Entrez votre nom',
                            'class' => 'common-input'
                        ],
                    'label' => false,
                    'constraints' =>
                        [
                            new NotBlank([
                                'message' => 'Veuillez entrer votre nom',
                            ]),
                            new Length([
                                'min' => 2,
                                'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères',
                                'max' => 255,
                                'maxMessage' => 'Votre nom ne peut pas contenir plus de {{ limit }} caractères',
                            ]),
                        ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' =>
                        [
                            'placeholder' => 'Entrez votre email',
                            'class' => 'common-input'
                        ],
                    'label' => false,
                    'constraints' =>
                        [
                            new NotBlank([
                                'message' => 'Veuillez entrer votre email',
                            ])
                        ]
                ]
            )
            ->add(
                'number',
                TelType::class,
                [
                    'attr' =>
                        [
                            'placeholder' => 'Entrez votre numéro de téléphone',
                            'class' => 'common-input'
                        ],
                    'label' => false,
                    'constraints' =>
                        [
                            new NotBlank([
                                'message' => 'Veuillez entrer votre numéro de téléphone',
                            ]),
                        ]
                ]
            )
            ->add(
                'subject',
                TextType::class,
                [
                    'attr' =>
                        [
                            'placeholder' => 'Entrez le sujet de votre message',
                            'class' => 'common-input'
                        ],
                    'label' => false,
                    'constraints' =>
                        [
                            new NotBlank([
                                'message' => 'Veuillez entrer le sujet de votre message',
                            ]),
                            new Length([
                                'min' => 2,
                                'minMessage' => 'Le sujet de votre message doit contenir au moins {{ limit }} caractères',
                                'max' => 255,
                            ])
                        ]
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'attr' =>
                        [
                            'placeholder' => 'Entrez votre message',
                            'class' => 'common-input'
                        ],
                    'label' => false,
                    'constraints' =>
                        [
                            new NotBlank([
                                'message' => 'Veuillez entrer votre message',
                            ]),
                            new Length([
                                'min' => 50,
                                'minMessage' => 'Votre message doit contenir au moins {{ limit }} caractères',
                                'max' => 5000,
                                'maxMessage' => 'Votre message ne peut pas contenir plus de {{ limit }} caractères',
                            ])
                        ]
                ]
            )
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(['message' => 'Prouvez que vous n\'êtes pas un robot']),
                'action_name' => 'homepage',
                'locale' => 'fr',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);

    }


}
