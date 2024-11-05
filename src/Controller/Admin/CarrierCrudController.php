<?php

namespace App\Controller\Admin;

use App\Entity\Carrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarrierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Carrier')
            ->setEntityLabelInPlural('Carriers')
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel("Carrier name"),
            TextareaField::new('description')->setLabel("Carrier Description"),
            NumberField::new('price')->setLabel('Price including tax')->setHelp('Price including tax of the carrier without the € sign')
        ];
    }
}
