<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Categories;
use App\StoreShoe\Models\Products;

class HomeController extends Controller{

    private Products $products;
    

    public function __construct()
    {
        $this->products = new Products();
        
    }
    public function index() {
        
        $products = $this->products->getAll();

        return $this->renderViewsClient('Home', [
            'products' => $products,
        ]);
    }

    public function general() {

        return $this->renderViewsClient('general');
    }

    public function contact() {

        return $this->renderViewsClient('contact');
    }

    
}