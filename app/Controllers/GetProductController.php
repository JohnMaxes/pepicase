<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\CustomSession;

class GetProductController extends BaseController
{
    public function index(): string
    {        
        $productModel = new Product();
        $data['products'] = $productModel->getProducts();
        return view('shop_page', $data);
    }

    public function get_with_id(int $id): string
    {
        $curr_session = new CustomSession(null);
        $product = new Product($id);
        if($product->check_if_found())
        {
            $data = $product->getFullInfo();
            if($curr_session->isSessionSet()) 
                $data['favorite'] = $curr_session->get_id();
            else
                $data['favorite'] = 'no';
            return view('product', $data);
        }
        else throw new \CodeIgniter\Exceptions\PageNotFoundException(view('errors/html/error_404'));
    }

    public function get_through_collections(): string
    {
        return view('collections');
    }
    public function filterProducts()
    {
        $productModel = new Product();

        $collections = $this->request->getPost('collections');
        $materials = $this->request->getPost('materials');
        $colors = $this->request->getPost('colors');

        $products = $productModel->filterProducts($collections, $materials, $colors);
        
        return view('product_list', ['products' => $products]);
    }
}
