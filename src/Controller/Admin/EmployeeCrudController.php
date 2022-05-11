<?php

namespace App\Controller\Admin;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $imageFile = Field::new('cvFile')->setFormType(VichImageType::class);
        $image = ImageField::new('cv')->setBasePath('/images/cvs');
        $fields = [
            TextField::new('nom'),
            TextField::new('prenom'),
            ChoiceField::new('sexe')->setChoices(['homme' => 'homme', 'femme' => 'femme']),
            DateField::new('Daten')->setLabel('date de naissance'),
            TextField::new('cin')->hideOnIndex(),
            EmailField::new('email'),
            TelephoneField::new('phone'),
            TextareaField::new('adresse'),
            TextField::new('cnss')->hideOnIndex(),
            IntegerField::new('rib')->hideOnIndex(),
            ChoiceField::new('nombanque')->setChoices([
                "Attijariwafa Bank" => "Attijariwafa Bank",
                "Banque Populaire du Maroc" => "Banque Populaire du Maroc",
                "bmci bank" => "bmci bank",
                "Société Générale Maroc" => "Société Générale Maroc",
                "BMCE" => "BMCE",
                "Crédit Agricole du Maroc" => "Crédit Agricole du Maroc",
                "Crédit du Maroc" => "Crédit du Maroc",
                "CIH Bank" => "CIH Bank",
            ])->hideOnIndex(),
            ChoiceField::new('statue')->setChoices([
                "Divorcé(e)" => "divorcé",
                "Marié(e)" => "marié",
                "célibataire" => "célibataire",
                "veuf(ve)" => "veuf"
            ])->hideOnIndex(),
            MoneyField::new('salaire')->setCurrency('MAD')->hideOnIndex(),
            ChoiceField::new('typecontrat')->setChoices([
                "6 Mois" => "6 Mois",
                "1 An" => "1 An",
                "2 Ans" => "2 Ans",
            ])->hideOnIndex(),
            ChoiceField::new('etat')->setChoices([
                "encore employé" => "encore employé",
                "à quitter" => "à quitter",
                "à décéder" => "à décéder",
                "retraité" => "retraité",
            ])->hideOnIndex(),
            ChoiceField::new('profile')->setChoices([
                "Developpeur" => "developpeur",
                "Comptable" => "comptable",
            ]),

            DateField::new('Datee')->setLabel("date d'emplois")->hideOnIndex(),
            TextField::new('username'),
            ArrayField::new('roles')->hideOnIndex(),
            AssociationField::new('division')->hideOnIndex(),
            TextField::new('password')->hideOnIndex(),

        ];
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }
        return $fields;
    }
}
