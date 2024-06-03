<?php

namespace App\StoreShoe\Controllers\Admin;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\ProductSize;

class ProductSizeController extends Controller
{

    private ProductSize $productSize;

    private string $folder = "ProductSize.";

    public function __construct()
    {
        $this->productSize = new ProductSize();
    }

    public function index()
    {
        $data['productSize'] = $this->productSize->getAll();

        return $this->renderViewsAdmin($this->folder . __FUNCTION__, $data);
    }
    public function create()
    {
        if (!empty($_POST)) {

            if (!isset($_SESSION['err'])) {
                $_SESSION['err'] = [];
            }
            $size = $_POST['size'];

            if (empty($size)) {
                $_SESSION['err']['size'] = "Bạn không thể để trống";
            }

            if (!is_numeric($size)) {
                $_SESSION['err']['size'] = "Kich cỡ phải là số";
            }

            if (empty($_SESSION['err']['size'])) {
                // debug($this->productSize->insert($size));
                $this->productSize->insert($size);
                header("location: /admin/productSize");
                exit();
            }
        }

        return $this->renderViewsAdmin($this->folder . __FUNCTION__);
    }
    public function update($id)
    {
        $data['size'] = $this->productSize->getByID($id);

        if (empty($data['size'])) {
            die(404);
        }

        if (!empty($_POST)) {

            if (!isset($_SESSION['err'])) {
                $_SESSION['err'] = [];
            }
            $size = $_POST['size'];

            if (empty($size)) {
                $_SESSION['err']['size'] = "Bạn không thể để trống";
            }

            if (!is_numeric($size)) {
                $_SESSION['err']['size'] = "Kich cỡ phải là số";
            }

            if (empty($_SESSION['err']['size'])) {
                // debug($this->productSize->insert($size));
                $this->productSize->update($id, $size);
                header("location: /admin/productSize");
                exit();
            }
        }
        return $this->renderViewsAdmin($this->folder . __FUNCTION__, $data);
    }
    public function delete($id)
    {
        $data['size'] = $this->productSize->getByID($id);

        $this->productSize->deleteByID($id);
        header("location: /admin/productSize");
        exit();
    }
}
