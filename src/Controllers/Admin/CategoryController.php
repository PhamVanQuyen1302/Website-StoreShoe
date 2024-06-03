<?php

namespace App\StoreShoe\Controllers\Admin;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Categories;

class CategoryController extends Controller
{


    private string $folder = "Categories.";

    private Categories $categories;

    public function __construct()
    {
        $this->categories = new Categories();
    }

    public function index()
    {
        $data['categories'] = $this->categories->getAll();
        // debug($data);

        return $this->renderViewsAdmin($this->folder . __FUNCTION__, $data);
    }

    public function create()
    {
        if (!empty($_POST)) {

            // Khởi tạo mảng lỗi trong session nếu chưa có
            if (!isset($_SESSION['err'])) {
                $_SESSION['err'] = [];
            }

            // Lấy dữ liệu từ POST
            $name = trim($_POST['name']);

            // Kiểm tra xem tên có rỗng hay không
            if (empty($name)) {
                $_SESSION['err']['category'] = 'Tên danh mục không được để trống';
            }

            // Nếu không có lỗi, tiếp tục chèn dữ liệu
            if (empty($_SESSION['err']['category'])) {
                $this->categories->insert($name);
                header('Location: /admin/categories');
                exit();
            }
        }

        return $this->renderViewsAdmin($this->folder . __FUNCTION__);
    }
    public function update($id)
    {
        $data['category'] = $this->categories->getByID($id);

        if (empty($data['category'])) {
            die(404);
        }

        if (!empty($_POST)) {
            // Khởi tạo mảng lỗi trong session nếu chưa có
            if (!isset($_SESSION['err'])) {
                $_SESSION['err'] = [];
            }

            // Lấy dữ liệu từ POST
            $name = trim($_POST['name']);

            // Kiểm tra xem tên có rỗng hay không
            if (empty($name)) {
                $_SESSION['err']['category'] = 'Tên danh mục không được để trống';
            }

            // Nếu không có lỗi, tiếp tục chèn dữ liệu
            if (empty($_SESSION['err']['category'])) {
                $this->categories->update($id,$name);
                header('Location: /admin/categories');
                exit();
            }
        }
        return $this->renderViewsAdmin($this->folder . __FUNCTION__, $data);
    }
    public function delete($id)
    {
        $data['category'] = $this->categories->getByID($id);

        if (empty($data['category'])) {
            die(404);
        }

        $this->categories->deleteByID($id);
        header('location: /admin/categories');
        exit();
    }
}
