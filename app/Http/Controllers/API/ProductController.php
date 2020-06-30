<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate();

        foreach ($products as &$product)
        {
            $product['images'] = $product->getAllImagesUrls();
        }

        return response()->json($products);
    }
}
