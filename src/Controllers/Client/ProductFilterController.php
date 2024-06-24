<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Categories;
use App\StoreShoe\Models\Products;

class ProductFilterController extends Controller
{

    private Categories $categories;
    private Products $products;

    public function __construct()
    {
        $this->categories = new Categories();
        $this->products  = new Products();
    }
    public function index()
    {
        $categories = $this->categories->getAll();


        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode('/', parse_url($url, PHP_URL_PATH));
        $currentId = end($parts);

        $getSizeByIdCategory =  $this->products->getSizeByIdCategory($currentId);

        $categoriesFist = $this->categories->getAllCategory($currentId);

        return $this->renderViewsClient('ProductFilter', [
            'categories' => $categories,
            'currentId' => $currentId,
            'categoriesFist' => $categoriesFist,
            'getSizeByIdCategory' => $getSizeByIdCategory
        ]);
    }

}
