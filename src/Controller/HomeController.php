<?php

namespace App\Controller;

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
        return $this->render('home.html.twig', array(
            'products' => $products,
            'blogs' => $blogs,
        ));
    }
}