<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->where('on_sale', 1)
            ->get();
        return $this->success($products);
    }

    public function show(Product $product)
    {
        if (!$product->on_sale) {
            return $this->error([], '商品未上架');
        }

        $reviews = OrderItem::query()
            ->with(['order:id,user_id','order.user:id,name','productSku:id,title'])// 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at')// 筛选出已评价的
            ->orderBy('reviewed_at', 'desc')// 按评价时间倒序
            ->first();
        $product->reviews = $reviews;
        $product->price_max = $product->skus->max('price');
        $product->price_min = $product->skus->min('price');

        return $this->success($product);
    }
}
