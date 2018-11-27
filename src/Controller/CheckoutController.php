<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\OrderState;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends Controller
{
    /**
     * @Route("/cart/checkout", name="cart-checkout")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        if(!$user) {
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        $cm = $this->get('cart_manager');
        $orderProducts = [];
        $items = $cm->getItems();
        $subTotal = 0;
        $shipping = 10;

        foreach ($items as $key => $value) {
            $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($value);
            $orderProducts[] = $orderProduct;
            $subTotal += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();

        }

        return $this->render('Shop/checkout-cart.html.twig', array(
            'orderProducts' => $orderProducts,
            'subTotal' => $subTotal,
            'shipping' => $shipping,
            'user' => $user
        ));
    }

    /**
     * @Route("/cart/checkout/payment", name="cart_payment")
     */
    public function paymentAction(Request $request) {
        $user = $this->getUser();

        if(!$user) {
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        elseif(!$user->getAddressDelivery()) {
            $this->addFlash(
                'notice',
                'You need to add an address delivery'
            );
            return $this->redirect($this->generateUrl('cart-checkout'));
        }

        $order = new Order();
        $cm = $this->get('cart_manager');
        $items = $cm->getItems();
        foreach ($items as $item) {
            $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($item);
            $order->addOrderProduct($orderProduct);
        }

        $state = $this->getDoctrine()->getManager()->getRepository(OrderState::class)->findOneBy(array(
            'name' => 'PROCESSING'
        ));

        $order->setUser($user);
        $order->setState($state);

        $this->getDoctrine()->getManager()->persist($order);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->remove("cart_items");
        $this->get('session')->remove("cart_items_number");

        return $this->redirect($this->generateUrl('fos_user_profile_show'));
    }
}