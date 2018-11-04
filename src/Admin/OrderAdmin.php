<?php

namespace App\Admin;

use App\Entity\OrderState;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use App\Entity\User;

class OrderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('state', EntityType::class, array(
            'class' => OrderState::class
        ));
        $formMapper->add('user', EntityType::class, [
            'class' => User::class
        ]);
        $formMapper->add('orderProducts', CollectionType::class,
            array(
                'by_reference' => false,
                'type_options' => array('delete' => false)
            ), array (
                'edit' => 'inline',
                'inline' => 'table',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('uniqId');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('uniqId');
        $listMapper->add('createdAt');
        $listMapper->add('state');
        $listMapper->add('total', null, array('label' => 'total ($)'));
        $listMapper->add('orderProducts');
        $listMapper->add('user');
    }
}