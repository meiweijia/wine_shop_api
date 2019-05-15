<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return redirect(route('admin.products.index'));
    }

    public function upload(Request $request)
    {
        $files = $request->file();

        $path = null;
        $data = null;
        foreach ($files as $file) {
            if ($file->isValid()) {
                $path = $file->store('images', 'public');
                $data[] = url('storage/' . $path);
            }
        }
        return [
            "errno" => 0,
            "data" => $data
        ];
    }
}
