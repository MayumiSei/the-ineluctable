<?php

namespace App\Controller;

use App\Entity\Faq;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FaqController extends Controller
{
    /**
     * @Route("/faq", name="faq")
     */
    public function indexAction(Request $request)
    {
        $faqs = $this->getDoctrine()->getManager()->getRepository(Faq::class)->findAll();

        return $this->render('footer/faq.html.twig', array(
            'faqs' => $faqs
        ));
    }
}