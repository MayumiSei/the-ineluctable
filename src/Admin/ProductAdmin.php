<?php

namespace App\Admin;

use App\Entity\Collection;
use App\Entity\Material;
use App\Entity\Category;
use App\Entity\Shape;
use App\Entity\Size;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('description', TextareaType::class);
        $formMapper->add('price', TextType::class);
        $formMapper->add('sizes', EntityType::class, [
            'class' => Size::class,
            'multiple' => false,
            'required' => false
        ]);
        $formMapper->add('materials', EntityType::class, [
            'class' => Material::class,
            'multiple' => true
        ]);
        $formMapper->add('category', EntityType::class, [
            'class' => Category::class,
            'multiple' => false
        ]);
        $formMapper->add('collection', EntityType::class, [
            'class' => Collection::class,
            'multiple' => false
        ]);
        $formMapper->add('shapes', EntityType::class, [
            'class' => Shape::class,
            'multiple' => true,
            'required' => false
        ]);
        $formMapper->add('gallery', ModelListType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->add('description');
        $listMapper->add('price');
        $listMapper->add('sizes');
        $listMapper->add('materials');
        $listMapper->add('category');
        $listMapper->add('collection');
        $listMapper->add('shapes');
        $listMapper->add('createdAt');
    }
}