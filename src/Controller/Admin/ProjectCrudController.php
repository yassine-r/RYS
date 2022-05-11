<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     $export = Action::new('export', 'actions.export')
    //         ->setIcon('fa fa-download')
    //         ->linkToCrudAction('export')
    //         ->setCssClass('btn')
    //         ->createAsGlobalAction();

    //     return $actions->add(Crud::PAGE_INDEX, $export);
    // }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            MoneyField::new('budget')->setCurrency('MAD')->hideOnIndex(),
            MoneyField::new('mpaye')->setCurrency('MAD')->hideOnIndex(),
            DateTimeField::new('datec'),
            TextField::new('type'),
            TextField::new('proprietaire'),
            ChoiceField::new('etat')->setChoices([
                "terminé" => "terminé",
                "en cours" => "en cours",
                "finaliser" => "finaliser",
                "livrer" => "livrer",
                "annuler" => "annuler",
            ]),
            MoneyField::new('depenses')->setCurrency('MAD')->hideOnIndex(),
            // MoneyField::new('facture')->setCurrency('MAD'),
            // TextField::new('bonlivraison'),
            AssociationField::new('employee')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            AssociationField::new('liste_phases')->hideOnIndex(),
        ];
    }

}
