<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function indexAction(Request $request) {

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')->where('p.title LIKE :title')
                ->setParameter('title', '%' . $request->get('search') .'%');
        $products = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->where('b.title LIKE :title')
            ->setParameter('title', '%' . $request->get('search') .'%');
        $blogs = $qb->getQuery()->getResult();

        return $this->render('search.html.twig', array(
            'products' => $products,
            'blogs' => $blogs,
            'search' => $request->get('search')
        ));
    }
}