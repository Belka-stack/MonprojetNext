<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Product')
            ->setEntityLabelInPlural('Products')
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $required = true;
        if ($pageName == 'edit') {
            $required = false;
        }
    
        return [
            TextField::new('name')->setLabel('Name')->setHelp('Name of your product'),
            SlugField::new('slug')->setTargetFieldName('name')->setLabel('URL')->setHelp('URL of your product is automatically generated'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('Description of your product'),
            ImageField::new('illustration')
            ->setLabel('Image')
            ->setHelp('Product image in 600x600px')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
            ->setBasePath('/uploads')
            ->setUploadDir('/public/uploads')
            ->setRequired($required)
            ,
            NumberField::new('price')->setLabel('Price Exclude Tax')->setHelp('Price Exclude Tax of the product without the € symbol '),
            ChoiceField::new('tva')->setLabel('VAT rate')->setChoices([
                '5,5%' => '5,5', // Le 5.5 représente ce qui va être stocké en BDD
                '10%' => '10',
                '20%' => '20'
            ]),
            AssociationField::new('category')->setLabel('Related category')
        ];
    }
    
}
