<?php

namespace App\Controller\Admin;

use App\Entity\Detail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Detail::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield IntegerField::new('quantite');
        yield AssociationField::new('plat');
        yield AssociationField::new('commande');
    }
}
