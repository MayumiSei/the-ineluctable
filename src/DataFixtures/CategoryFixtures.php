<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Jewellery');
        $category1->addType($this->getReference('type1'));
        $category1->addType($this->getReference('type2'));
        $category1->addType($this->getReference('type3'));
        $category1->addType($this->getReference('type4'));
        $category1->addType($this->getReference('type5'));

        $category2 = new Category();
        $category2->setName('Accessories');

        $category3 = new Category();
        $category3->setName('Decoration');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
    }

    public function getDependencies()
    {
        return array(
            TypeFixtures::class,
        );
    }
}