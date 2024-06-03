<?php

namespace App\StoreShoe\Controllers\Admin;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Products;

class ProductController extends Controller
{

    private Products $products;

    private string $folder = "Products.";

    const PATH_UPLOAD = '/uploads/products/';

    public function __construct()
    {
        $this->products = new Products();
    }

    public function index()
    {
        $products = $this->products->getAll();


        // $productChuck = array_chunk($products, 10);

        return $this->renderViewsAdmin($this->folder . __FUNCTION__, [
            'products' => $products,
        ]);
    }
    public function create()
    {
        $categories = $this->products->getCategory();

        if(!empty($_POST)) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $image = $_FILES['image'];
            $imagePath = null;

            if(!empty($image)) {
                $imagePath = self::PATH_UPLOAD . time() . $image['name'];
                if(!move_uploaded_file($image['tmp_name'], PATH_ROOT. $imagePath)) {
                    $imagePath = null;
                }
            }
            $this->products->insert(
                $name,
                $price, 
                $quantity, 
                $description, 
                $imagePath, 
                $category_id
            );
            header('location: /admin/products');
            exit();
        }

        return $this->renderViewsAdmin($this->folder . __FUNCTION__ , ['categories'=> $categories] );
    }
    public function show($id)
    {
        $product = $this->products->getByID($id);


        if(empty($product)) {
            die(404);
        }
        return $this->renderViewsAdmin($this->folder . __FUNCTION__ , ['product'=> $product] );
    }
    public function update($id)
    {
        $product = $this->products->getByID($id);

        $categories = $this->products->getCategory();

        if(empty($product)) {
            die(404);
        }

        if(!empty($_POST)) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $image = $_FILES['image'];
            $imagePath = null;

            $move = false;

            if(!empty($image)) {
                $imagePath = self::PATH_UPLOAD . time() . $image['name'];
                if(!move_uploaded_file($image['tmp_name'], PATH_ROOT. $imagePath)) {
                    $imagePath = $product['p_image'];
                }
            }
            $this->products->update(
                $id,
                $name,
                $price, 
                $quantity, 
                $description, 
                $imagePath, 
                $category_id
            );

            if($move && $product['p_image'] && file_exists((PATH_ROOT . $product['p_image'])) ) {
                unlink(PATH_ROOT. $product['p_image']);
            }
            header('location: /admin/products');
            exit();
        }

        return $this->renderViewsAdmin($this->folder . __FUNCTION__ , [
            'categories'=> $categories,
            'product' => $product
        ] );
    }
    public function delete($id)
    {
        $product = $this->products->getByID($id);

        if(empty($product)) {
            die(404);
        }

        $this->products->deleteByID($id);

        if (!empty($product['p_image']) && file_exists(PATH_ROOT . $product['p_image'])) {
            unlink(PATH_ROOT . $product['p_image']);
        }
        header('location: /admin/products');
        exit();

    }
}
