<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $type1 = new Type();
        $type1->setName('Necklace');

        $type2 = new Type();
        $type2->setName('Bracelet');

        $type3 = new Type();
        $type3->setName("Earrings");

        $type4 = new Type();
        $type4->setName("Brooch");

        $type5 = new Type();
        $type5->setName("Ring");


        $manager->persist($type1);
        $manager->persist($type2);
        $manager->persist($type3);
        $manager->persist($type4);
        $manager->persist($type5);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('type1', $type1);
        $this->addReference('type2', $type2);
        $this->addReference('type3', $type3);
        $this->addReference('type4', $type4);
        $this->addReference('type5', $type5);
    }
}