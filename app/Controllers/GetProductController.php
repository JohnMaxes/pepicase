<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\CustomSession;
use App\Models\Cart;

class GetProductController extends BaseController
{
    public function index(): string // hàm trả về trang gồm filter
    {        
        $productModel = new Product(); // khởi tạo đối tượng product
        $data['products'] = $productModel->getProducts(); // chạy hàm lấy info sản phẩm
        return view('shop_page', $data); // trả về trang filter bao gồm gói data
    }

    public function get_with_id(int $id): string // hàm trả về trang /product/(id)
    {
        $curr_session = new CustomSession(null); // khởi tạo đối tượng session để chạy hàm
        $product = new Product($id); // khởi tạo đối tượng product với id đc request
        $data = $product->getFullInfo(); // lấy thông tin sản phẩm
        if($product->check_if_found()) // nếu tìm thấy sản phẩm trong database
        {
            if($curr_session->isSessionSet()) // nếu session có người dùng rồi
            {
                // tiến hành kiểm tra người dùng đó có wishlist spham đó k
                $user_id = $curr_session->get_id(); // lấy id người dùng từ session
                if ($product->check_favorited($user_id)) // nếu có favorite
                $data['favorite'] = 'yes'; // thêm vào gói data $favorite = 'yes'
                else // nếu không thì ngược lại
                $data['favorite'] = 'no';
                return view('product', $data); // trả data về view để xử lý trên view đó
            }
            else // nếu session chưa có người dùng
            {
                $curr_session->fetch_session_cookie(); // kiểm tra cookie trên máy, và nhập lên nếu có
                if($curr_session->isSessionSet()) // nếu sau đó có session
                {
                    $user_id = $curr_session->get_id();
                    if ($product->check_favorited($user_id)) $data['favorite'] = 'yes';
                    else $data['favorite'] = 'no';
                    // làm lại process trên
                }
                return view('product', $data); // nếu không trả về view với $data rỗng
            }
        }
        else throw new \CodeIgniter\Exceptions\PageNotFoundException(view('errors/html/error_404'));
    }

    public function get_through_collections(): string // trả về trang collections
    {
        return view('collections');
    }
    public function getFilteredProducts()
    {
        $request = service('request');
        $filters = $request->getJSON(true);
        
        $collectionFilter = $filters['collections'];
        $colorFilter = $filters['colors'];
        
        $db = \Config\Database::connect();
        $builder = $db->table('product');
    
        if (!empty($collectionFilter)) {
            $builder->whereIn('Collect_ID', $collectionFilter);
        }
    
        if (!empty($colorFilter)) {
            $builder->groupStart();
            foreach ($colorFilter as $colorId) {
                $builder->orWhere('Color_ID', $colorId);
            }
            $builder->groupEnd();
        }
    
        $query = $builder->get();
        $products = $query->getResultArray();
    
        return $this->response->setJSON(['products' => $products]);
    }
    public function getAllProducts()
    {
        $productModel = new Product();
        $products = $productModel->getProducts();
        return $this->response->setJSON(['products' => $products]);
    }


    public function toggleFavorite() // trigger khi ấn hình quả tim (có ý định favorite)
    {
        $product = $this->request->getPost('product');
        $user_id = $this->request->getPost('user_id');
        // lấy data từ post request từ trang product

        $curr_product = new Product($product);
        $curr_product->toggleFavorite($user_id);
        // gọi hàm toggleFavorite, những luận lý liên quan xảy ra trong JS trên trang
    }
    public function add_to_cart() // đang làm
    {
        $product = $this->request->getPost('product');
        $user_id = $this->request->getPost('user_id');
        $size = $this->request->getPost('size');
        $quantity = $this->request->getPost('quantity');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');

        $cart = new Cart($user_id);
        $result = $cart->add_item($product, $name , $size, $quantity, $price);
        // Prepare the AJAX response
        if ($result) {
            $response = 'Item added successfully';
        } else {
            $response = 'Failed to add item to cart.';
        }
        
        // Set content type to application/x-www-form-urlencoded
        $this->response->setContentType('application/x-www-form-urlencoded');
        return $this->response->setBody($response);
    }

    public function checkout(){
        return view('checkout');
    }

    public function yourcart(){
        return view('emptycart');
    }
}
