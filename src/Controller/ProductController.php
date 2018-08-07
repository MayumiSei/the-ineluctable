<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Material;
use App\Entity\Product;
use App\Entity\Shape;
use App\Entity\Size;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function indexAction(Request $request)
    {
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();

        $materials = $this->getDoctrine()->getManager()->getRepository(Material::class)->findAll();
        //die(var_dump($request));
        $shapes = $this->getDoctrine()->getManager()->getRepository(Shape::class)->findAll();
        $colors = $this->getDoctrine()->getManager()->getRepository(Color::class)->findAll();
        $sizes = $this->getDoctrine()->getManager()->getRepository(Size::class)->findAll();

        return $this->render('products.html.twig', array(
            'products' => $products,
            'materials' => $materials,
            'shapes' => $shapes,
            'colors' => $colors,
            'sizes' => $sizes
        ));
    }

    /**
     * @Route("/product/1", name="product-detail")
     */
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findBy(array('collection' => $product->getCollection()));

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')->setMaxResults('8');
        $latestProducts = $qb->getQuery()->getResult();

        // replace this example code with whatever you need
        return $this->render('product-detail.html.twig', array(
            'product' => $product,
            'products' => $products,
            'latestProducts' => $latestProducts
        ));
    }
}