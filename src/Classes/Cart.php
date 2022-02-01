<?php

namespace App\Classes;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function add($id)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
    }

    public function get()
    {
        $session = $this->requestStack->getSession('cart');
        return $session->get('cart');
    }

    public function remove()
    {
        $session = $this->requestStack->getSession('cart');
        return $session->remove('cart');
    }
}