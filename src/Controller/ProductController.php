<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Material;
use App\Entity\Product;
use App\Entity\Shape;
use App\Entity\Size;
use App\Entity\Type;
use Doctrine\ORM\QueryBuilder;
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
        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p');
        if($request->request->get('material') && $request->request->get('material') !== 'All')
        {
            $qb->join('p.materials', 'm')->where('m.id = :material')->setParameter('material', $request->request->get('material'));
        }
        if($request->request->get('shape') && $request->request->get('shape') !== 'All')
        {
            $qb->join('p.shapes', 'sh')->andWhere('sh.id = :shape')->setParameter('shape', $request->request->get('shape'));
        }
        if($request->request->get('color') && $request->request->get('color') !== 'All')
        {
            $qb->join('p.colors', 'c')->andWhere('c.id = :color')->setParameter('color', $request->request->get('color'));
        }
        if($request->request->get('size') && $request->request->get('size') !== 'All')
        {
            $qb->join('p.sizes', 'si')->andWhere('si.id = :size')->setParameter('size', $request->request->get('size'));
        }
        if($request->get('type'))
        {
            $qb->andWhere('p.type = :type')->setParameter('type', $request->get('type'));
        }

        // A faire Price
        if($request->get('category'))
        {
            $qb->join('p.type', 't')->join('t.category' , 'c')->where('c.id = :category')->setParameter('category', $request->get('category'));
        }
        if($request->get('collection'))
        {
            $qb->andWhere('p.collection = :collection')->setParameter('collection', $request->get('collection'));
        }

        $products = $qb->getQuery()->getResult();
        $materials = $this->getDoctrine()->getManager()->getRepository(Material::class)->findAll();
        $shapes = $this->getDoctrine()->getManager()->getRepository(Shape::class)->findAll();
        $colors = $this->getDoctrine()->getManager()->getRepository(Color::class)->findAll();
        $sizes = $this->getDoctrine()->getManager()->getRepository(Size::class)->findAll();
        $types = $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();

        return $this->render('shop/products.html.twig', array(
            'products' => $products,
            'materials' => $materials,
            'shapes' => $shapes,
            'colors' => $colors,
            'sizes' => $sizes,
            'types' => $types
        ));
    }

    /**
     * @Route("/product/{id}", name="product-detail")
     */
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findBy(array('collection' => $product->getCollection()));

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')->setMaxResults('8');
        $latestProducts = $qb->getQuery()->getResult();

        // replace this example code with whatever you need
        return $this->render('shop/product-detail.html.twig', array(
            'product' => $product,
            'products' => $products,
            'latestProducts' => $latestProducts
        ));
    }
}