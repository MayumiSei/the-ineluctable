<?php

namespace App\DataFixtures;

use App\Entity\OrderState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OrderStateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $orderState1 = new OrderState();
        $orderState1->setName('Pending');

        $orderState2 = new OrderState();
        $orderState2->setName('Processing');

        $orderState3 = new OrderState();
        $orderState3->setName('Shipped');


        $manager->persist($orderState1);
        $manager->persist($orderState2);
        $manager->persist($orderState3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('orderState1', $orderState1);
        $this->addReference('orderState2', $orderState2);
        $this->addReference('orderState3', $orderState3);
    }
}