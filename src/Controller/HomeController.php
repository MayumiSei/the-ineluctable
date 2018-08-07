<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Collection;
use App\Entity\Slide;
use App\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\Blog;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')->setMaxResults('8');
        $products = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')
            ->orderBy('b.createdAt', 'DESC')->setMaxResults('3');
        $blogs = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('c')->from(Collection::class, 'c')
            ->orderBy('c.createdAt', 'DESC')->setMaxResults('3');
        $collections = $qb->getQuery()->getResult();

        $categories = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAll();

        $types = $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();

        $slides = $this->getDoctrine()->getManager()->getRepository(Slide::class)->findAll();
        return $this->render('home.html.twig', array(
            'products' => $products,
            'blogs' => $blogs,
            'collections' => $collections,
            'categories' => $categories,
            'types' => $types,
            'slides' => $slides,
        ));
    }
}