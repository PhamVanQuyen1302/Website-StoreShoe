<?php

namespace App\StoreShoe\Controllers\Admin;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\ProductProperties;

class ProductPropertiesController extends Controller {
    
    private ProductProperties $productProperties;

    private string $folder = "ProductProperties.";
    
    public function __construct() 
    {
        $this->productProperties = new ProductProperties();
    }

    public function index() {
        $properties = $this->productProperties->getAll();

        // debug($properties);

        return $this->renderViewsAdmin($this->folder . __FUNCTION__, [
            'properties' => $properties,
        ]);
    }

    public function create() {

        $products = $this->productProperties->getProduct();
        $sizes = $this->productProperties->getProductSize();

        // debug($sizes);
        // debug();

        if(!empty($_POST)) {

            $product_id = $_POST['product_id'];
            $size_id = $_POST['size_id'];

            $this->productProperties->insert($product_id,$size_id);

            header('location: /admin/product-properties');
            exit();
        }
        return $this->renderViewsAdmin($this->folder . __FUNCTION__,[
            'products' => $products,
            'sizes' => $sizes,
        ]);
    }

    public function show($id) {
        
    }

    public function update($id) {
        $properties = $this->productProperties->getByID($id);
        $products = $this->productProperties->getProduct();
        $sizes = $this->productProperties->getProductSize();

        if(empty($properties)) {
            die(404);
        }

        if(!empty($_POST)) {

            $product_id = $_POST['product_id'];
            $size_id = $_POST['size_id'];

            $this->productProperties->update($id, $product_id, $size_id);

            header('location: /admin/product-properties');
            exit();
        }
        return $this->renderViewsAdmin($this->folder . __FUNCTION__,[
            'properties' => $properties,
            'products' => $products,
            'sizes' => $sizes,
        ]);
    }

    public function delete($id) {

        $properties = $this->productProperties->getByID($id);
        
        if(empty($properties)) {
            die(404);
        }

        $this->productProperties->deleteByID($id);
        header('location: /admin/product-properties');
            exit();
    }
}