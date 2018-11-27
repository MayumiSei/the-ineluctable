<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use App\Entity\Blog;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction(Request $request)
    {
        if($request->get('tag'))
        {
            $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->join('b.tags', 't')
                ->where('t.id = :tag')->orderBy('b.createdAt', 'DESC')->setParameter('tag', $request->get('tag'));
        } else
            $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->orderBy('b.createdAt', 'DESC');

        $tags = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findAll();

        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);

        $page = 1;
        if($request->get('page'))
        {
            $page = $request->get('page');
        }

        try
        {
            $blogs = $pagerfanta
                ->setMaxPerPage(2)
                ->setCurrentPage($page)
                ->getCurrentPageResults()
            ;
        } catch (\Pagerfanta\Exception\NotValidCurrentPageException $e) {
            throw $this->createNotFoundException("Page not found");
        }

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')->setMaxResults('3');
        $latestProducts = $qb->getQuery()->getResult();

        return $this->render('Blog/blog.html.twig', array(
            'blogs' => $blogs,
            'tags' => $tags,
            'pager' => $pagerfanta,
            'latestProducts' => $latestProducts
        ));
    }

    /**
     * @Route("/blog/{id}", name="blog-detail")
     */
    public function showAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->find($request->get('id'));
        $tags = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findAll();
        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')->setMaxResults('3');
        $latestProducts = $qb->getQuery()->getResult();

        return $this->render('Blog/blog-detail.html.twig', array(
            'blog' => $blog,
            'tags' => $tags,
            'latestProducts' => $latestProducts
        ));
    }
}