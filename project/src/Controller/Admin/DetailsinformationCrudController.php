<?php

namespace App\Controller\Admin;

use App\Entity\Detailsinformation;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DetailsinformationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Detailsinformation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('areaSize', 'Surface')
                ->setColumns(4)
                ->setHelp('Surface en m²'),
            TextField::new('sizePrefix', 'Prefixe')
                ->setColumns(4),
            TextField::new('landArea', 'Terrain')
                ->setColumns(4),
            TextField::new('bedroom', 'Chambres')
                ->setColumns(4),
            TextField::new('bathrooms', 'Salles de bain')
                ->setColumns(4),
            TextField::new('garages', 'Garages')
                ->setColumns(4),
            DateField::new('yearBuild', 'Année de construction')
                ->setColumns(4),

        ];
    }

}
