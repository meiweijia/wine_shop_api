<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddCartRequestRequest;
use App\Models\CartItem;
use App\Models\ProductSku;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends ApiController
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->get();
        return $this->success($cartItems);
    }

    public function store(AddCartRequestRequest $request)
    {
        $result = $this->cartService->add($request->input('sku_id'), $request->input('amount'));

        return $this->success($result);
    }

    public function destroy(CartItem $cart)
    {
        $this->cartService->remove($cart->product_sku_id);
        return $this->success([]);
    }

    public function flush(){
        $this->cartService->remove();
        return $this->success([]);
    }
}
