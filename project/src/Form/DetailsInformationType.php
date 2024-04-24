<?php

namespace App\Form;

use App\Entity\Detailsinformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('areaSize')
            ->add('sizePrefix')
            ->add('landArea')
            ->add('bedroom')
            ->add('bathrooms')
            ->add('garages')
            ->add('yearBuild', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detailsinformation::class,
        ]);
    }
}
