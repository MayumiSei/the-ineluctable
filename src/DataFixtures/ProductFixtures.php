<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Application\Sonata\MediaBundle\Entity\GalleryHasMedia;
use App\Application\Sonata\MediaBundle\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setTitle('Crescent');
        $product1->setPrice('49.99');
        $product1->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product1->setType($this->getReference('type1'));
        $product1->setState($this->getReference('state1'));
        $product1->setCollection($this->getReference('collection1'));
        $product1->addSize($this->getReference('size1'));
        $product1->addShape($this->getReference('shape1'));
        $product1->setMaterial($this->getReference('material1'));

        $gallery1 = $this->createGallery('crescent');

        $media1File = new File(__DIR__ . '/../../public/images/crescent.jpg');
        $media1 = $this->createMedia($media1File, 'product1-1.jpg');
        $galleryHasMedia1 = $this->createGalleryHasMedia($media1);

        $media2File = new File(__DIR__ . '/../../public/images/crescent2.jpg');
        $media2 = $this->createMedia($media2File, 'product1-2.jpg');
        $galleryHasMedia2 = $this->createGalleryHasMedia($media2);

        $media3File = new File(__DIR__ . '/../../public/images/crescent3.jpg');
        $media3 = $this->createMedia($media3File, 'product1-3.jpg');
        $galleryHasMedia3 = $this->createGalleryHasMedia($media3);

        $gallery1->addGalleryHasMedia($galleryHasMedia1);
        $gallery1->addGalleryHasMedia($galleryHasMedia2);
        $gallery1->addGalleryHasMedia($galleryHasMedia3);

        $product1->setGallery($gallery1);

        // -------------  PRODUCT 2

        $product2 = new Product();
        $product2->setTitle('Pulsar');
        $product2->setPrice('59.99');
        $product2->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product2->setType($this->getReference('type2'));
        $product2->setState($this->getReference('state2'));
        $product2->setCollection($this->getReference('collection1'));
        $product2->addSize($this->getReference('size2'));
        $product2->addShape($this->getReference('shape2'));
        $product2->setMaterial($this->getReference('material2'));

        $gallery2 = $this->createGallery('pulsar');

        $media4File = new File(__DIR__ . '/../../public/images/pulsar.jpg');
        $media4 = $this->createMedia($media4File, 'product2-1.jpg');
        $galleryHasMedia4 = $this->createGalleryHasMedia($media4);

        $media5File = new File(__DIR__ . '/../../public/images/pulsar1.jpg');
        $media5 = $this->createMedia($media5File, 'product2-2.jpg');
        $galleryHasMedia5 = $this->createGalleryHasMedia($media5);

        $gallery2->addGalleryHasMedia($galleryHasMedia4);
        $gallery2->addGalleryHasMedia($galleryHasMedia5);

        $product2->setGallery($gallery2);

        // -------------  PRODUCT 3

        $product3 = new Product();
        $product3->setTitle('Moon Phase');
        $product3->setPrice('69.99');
        $product3->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product3->setType($this->getReference('type3'));
        $product3->setCollection($this->getReference('collection1'));
        $product3->addSize($this->getReference('size3'));
        $product3->addShape($this->getReference('shape3'));
        $product3->setMaterial($this->getReference('material3'));

        $gallery3 = $this->createGallery('Moon-phase');

        $media7File = new File(__DIR__ . '/../../public/images/moon-phase.jpg');
        $media7 = $this->createMedia($media7File, 'product3-1.jpg');
        $galleryHasMedia7 = $this->createGalleryHasMedia($media7);

        $media8File = new File(__DIR__ . '/../../public/images/moon-phase2.jpg');
        $media8 = $this->createMedia($media8File, 'product3-2.jpg');
        $galleryHasMedia8 = $this->createGalleryHasMedia($media8);

        $media9File = new File(__DIR__ . '/../../public/images/moon-phase3.jpg');
        $media9 = $this->createMedia($media9File, 'product3-3.jpg');
        $galleryHasMedia9 = $this->createGalleryHasMedia($media9);

        $gallery3->addGalleryHasMedia($galleryHasMedia7);
        $gallery3->addGalleryHasMedia($galleryHasMedia8);
        $gallery3->addGalleryHasMedia($galleryHasMedia9);

        $product3->setGallery($gallery3);

        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('product1', $product1);
        $this->addReference('product2', $product2);
        $this->addReference('product3', $product3);
    }

    public function createMedia($file, $filename)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');

        $media = $mediaManager->create();
        $media->setEnabled(true);
        $media->setBinaryContent($file);
        $media->setName($filename);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $media->setProviderStatus(1);

        $mediaManager->save($media);

        return $media;
    }

    public function createGalleryHasMedia($media){
        $galleryHasMedia = new GalleryHasMedia();
        $galleryHasMedia->setMedia($media);
        $galleryHasMedia->setEnabled(true);

        return $galleryHasMedia;
    }

    protected function createGallery($name) {
        $gallery = new Gallery();
        $gallery->setName($name);
        $gallery->setEnabled(true);
        $gallery->setContext('default');
        $gallery->setDefaultFormat('big');

        return $gallery;
    }

    public function getDependencies()
    {
        return array(
            TypeFixtures::class,
            CollectionFixtures::class,
            SizeFixtures::class,
            ShapeFixtures::class,
            MaterialFixtures::class,
            StateFixtures::class,
        );
    }
}