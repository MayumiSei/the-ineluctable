<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    /**
     * @Route("/header", name="header")
     */
    public function menuAction(Request $request) {
        $categories = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAll();

        $types = $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();

        return $this->render('header.html.twig', array(
            'categories' => $categories,
            'types' => $types,
            'route' => $request->get('route')
        ));
    }
}