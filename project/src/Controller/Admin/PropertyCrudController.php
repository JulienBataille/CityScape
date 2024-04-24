<?php

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Controller\Admin\GalleryCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use App\Controller\Admin\DetailsinformationCrudController;
use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Général'),
            IdField::new('id')->onlyOnIndex(),
            SlugField::new('slug')
                ->setTargetFieldName('propertyTitle')
                ->hideOnIndex(),
            ImageField::new('pictures[0].imageName', 'Image')
                ->setBasePath('assets/images/bienimmo')
                ->onlyOnIndex(),
            TextField::new('propertyTitle', 'Titre')
                ->setColumns(6),
            TextField::new('price', 'Prix')
                ->setColumns(6)
                ->setHelp('Prix en €'),
            TextField::new('area', 'Surface')
                ->setColumns(6)
                ->setHelp('Surface en m²'),
            AssociationField::new('agentImmo', 'Agent Immobilier')
                ->setFormTypeOptions([
                    'query_builder' => function ($entityRepository) {
                        return $entityRepository->createQueryBuilder('u')
                            ->andWhere('u.roles LIKE :roles')
                            ->setParameter('roles', '%"ROLE_AGENT"%');
                    },
                ])
                ->setColumns(6),
            TextField::new('statuts.parent', 'Categorie')
                ->onlyOnIndex(),
            TextField::new('statuts', 'Bien')
                ->onlyOnIndex(),
            AssociationField::new('statuts', 'Categorie')
                ->setColumns(6)
                ->hideOnIndex(),
            TextEditorField::new('description', 'Description')
                ->setTrixEditorConfig([
                    'blockAttributes' => [
                        'default' => ['tagName' => 'p'],
                        'heading1' => ['tagName' => 'h1'],
                    ]
                ])
                ->hideOnIndex()
                ->setColumns(12),

            FormField::addTab('Details'),
            AssociationField::new('detailsInformation', 'Details')
                ->renderAsEmbeddedForm(DetailsinformationCrudController::class)
                ->hideOnIndex(),

            FormField::addTab('Images'),
            CollectionField::new('pictures', 'Images')
                    ->useEntryCrudForm(GalleryCrudController::class)
                    ->onlyOnForms(),

            FormField::addTab('Équipements'),
            CollectionField::new('amenities', 'Équipements')
                ->useEntryCrudForm(AmenitiesCrudController::class)
                ->hideOnIndex(),
            
        ];
    }

}
