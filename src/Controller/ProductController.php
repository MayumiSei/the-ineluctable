<?php

namespace App\Controller;

use App\Entity\Product;
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
        return $this->render('products.html.twig', array(
            'products' => $products
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