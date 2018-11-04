<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\OrderState;
use App\Entity\Product;
use App\Entity\Shape;
use App\Entity\Size;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction(Request $request)
    {
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

        return $this->render('shop/shoping-cart.html.twig', array(
            'orderProducts' => $orderProducts,
            'subTotal' => $subTotal,
            'shipping' => $shipping
        ));
    }

    /**
     * @Route("/cart/add", name="cart-add")
     */
    public function addAction(Request $request)
    {
        $orderProduct = new OrderProduct();
        if($request->get('product')) {
            $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('product'));
            if($product)
            {
                $orderProduct->setProduct($product);
            }
        }
        if($request->get('size')) {
            $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($request->get('size'));
            if($size)
            {
                $orderProduct->setSize($size);
            }
        }
        if($request->get('shape')) {
            $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($request->get('shape'));
            if($shape)
            {
                $orderProduct->setShape($shape);
            }
        }
        if($request->get('material')) {
            $material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($request->get('material'));
            if($material)
            {
                $orderProduct->setMaterial($material);
            }
        }
        if($request->get('color')) {
            $color = $this->getDoctrine()->getManager()->getRepository(Color::class)->find($request->get('color'));
            if($color)
            {
                $orderProduct->setColor($color);
            }
        }
        if($request->get('quantity')) {
            $orderProduct->setQuantity($request->get('quantity'));
        }
        $this->getDoctrine()->getManager()->persist($orderProduct);
        $this->getDoctrine()->getManager()->flush();

        $cm = $this->get('cart_manager');
        $cm->addItem($orderProduct->getId(), $orderProduct->getQuantity());

        $response = new Response('ok');
        return $response;
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function removeAction(Request $request)
    {
        $cm = $this->get('cart_manager');
        $cm->removeItem($request->get('id'), $request->get('quantity'));

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * @Route("/cart/payment", name="cart_payment")
     */
    public function paymentAction(Request $request) {
        $user = $this->getUser();

        if(!$user) {
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
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