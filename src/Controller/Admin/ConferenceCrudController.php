<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConferenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {

        return Conference::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference')
            ->setEntityLabelInPlural('Conferences')
            ->setSearchFields(['city', 'year', 'isInternational'])
            ->setDefaultSort(['year' => 'DESC']);
    }
    public function configureFields(string $pageName): iterable
    {
//        yield TextField::new('city');
//        yield TextField::new('year');
//        yield BooleanField::new('international');

        return [
            Field::new('city'),
            Field::new('year'),
            BooleanField::new('international'),
        ];
    }
}
