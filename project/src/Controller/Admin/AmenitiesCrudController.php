<?php

namespace App\Controller\Admin;

use App\Entity\Amenities;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AmenitiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Amenities::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom')
                ->setColumns(4)

        ];
    }
    
}
