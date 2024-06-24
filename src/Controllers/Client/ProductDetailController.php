<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Products;

class ProductDetailController extends Controller {
    
    private Products $products;

    public function __construct() 
    {
        $this->products = new Products();
    }

    public function index($id) {

        $product = $this->products->getProductDetail($id);
        $sizes = $this->products->getSizeByIdProduct($id);
        // debug($sizes);

        return $this->renderViewsClient('ProductDetail', [
            'product' => $product,
            'sizes' =>  $sizes
        ]);
    }
}