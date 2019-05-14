<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends ApiController
{
    public function index(Request $request){
        $banners = Banner::query()
            ->get();
        return $this->success($banners);
    }
}
