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

        //评价
        $reviews = OrderItem::query()
            ->with(['order:id,user_id', 'order.user:id,name', 'productSku:id,title'])// 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at')// 筛选出已评价的
            ->orderBy('reviewed_at', 'desc')// 按评价时间倒序
            ->first();
        //推荐
        $similarProducts = Product::query()
            ->where('id', '<>', $product->id)//排除自己
            ->inRandomOrder()//随机排序
            ->take(mt_rand(3, 6))//随机取3-6条数据
            ->get();

        $product->reviews = $reviews;
        $product->price_max = $product->skus->max('price');//商品最大价格
        $product->price_min = $product->skus->min('price');//商品最小价格
        $product->similar = $similarProducts;

        return $this->success($product);
    }
}
