<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function index(Request $request){
        $products = Product::query()
            ->where('on_sale',1)
            ->get();
        return $this->success($products);
    }

    public function show(Product $product){
        return $this->success($product);
    }
}
