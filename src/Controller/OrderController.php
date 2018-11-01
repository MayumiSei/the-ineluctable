<?php

namespace App\Controller;

use App\Entity\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/profile/order/{orderNumber}", name="order")
     */
    public function indexAction(Request $request) {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->findOneBy(array(
            'uniqId' => $request->get('orderNumber')));

        return $this->render('shop/order-detail.html.twig', array(
            'order' => $order
        ));
    }
}