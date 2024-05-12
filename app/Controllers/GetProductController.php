<?php

namespace App\Controllers;
use App\Models\Product;

class GetProductController extends BaseController
{
    public function index(): string
    {
        return view('shop_page');
    }

    public function get_with_id(int $id): string
    {
        $product = new Product($id);
        if($product->check_if_found())
        {
            return view('product', $product->getFullInfo());
        }
        else return view('testing');
    }

    public function get_through_collections(): string
    {
        return view('collections');
    }
}
