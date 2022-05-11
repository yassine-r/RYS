<?php

namespace App\Controller\Admin;

use App\Entity\Phase;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class PhaseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Phase::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom')->setLabel("nom de la phase"),
            DateField::new('dated')->setLabel("date de début"),
            DateField::new('datef')->setLabel("date de fin"),
            AssociationField::new('liste_taches')->hideOnIndex(),
        ];
    }
}
