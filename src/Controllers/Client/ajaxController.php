<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Categories;
use App\StoreShoe\Models\Products;

class AjaxController extends Controller
{
    private Products $products;
    private Categories $categories;

    private string $fodel = "cart.";

    public function __construct()
    {
        $this->products = new Products();
        $this->categories = new Categories();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    public function filter_data()
    {
        $conditions = '';
        $id = $_GET['id'];

        if (!empty($_GET['action'])) {
            if (isset($_GET['sizes']) && is_array($_GET['sizes'])) {
                $sizes_filter = implode("','", $_GET['sizes']);
                $conditions .= "AND ps.size IN ('" . $sizes_filter . "') ";
            }

            if (isset($_GET['priceFrom'], $_GET['priceTo'])) {
                $conditions .= " AND p.price BETWEEN " . intval($_GET['priceFrom']) . " AND " . intval($_GET['priceTo']);
            }

            $resultProductFilter = $this->products->resultProductFilter($id, $conditions);

            $count = count($resultProductFilter);

            $output = '';

            if ($count > 0) {
                foreach ($resultProductFilter as $item) {
                    $output .= '
                        <div data-id="' . htmlspecialchars($item['p_id']) . '" class="col-lg-25 product-wrapper in-category p-ivt p-' . htmlspecialchars($item['p_id']) . '">
                            <div class="product-information">
                                <div class="col-lg-4 col-md-4 col-xs-6 col-sm-6 box_tab_index prdWrapper" data-pid="' . htmlspecialchars($item['p_id']) . '">
                                    <div class="box-product">
                                        <div class="inner-item sold-out">
                                            <div class="p-image clearfix">
                                                <a class="a-image" href="/product/' . htmlspecialchars($item['p_id']) . '">
                                                    <img src="' . htmlspecialchars($item['p_image']) . '" class="attachment-medium size-medium wp-post-image" alt="' . htmlspecialchars($item['p_name']) . '" />
                                                </a>
                                                <div class="btn-quickview tp_button" data-psId="37834087"><i class="fal fa-eye"></i><span> <a href="/product/' . htmlspecialchars($item['p_id']) . '">Xem Ngay</a></span></div>
                                            </div>
                                            <div class="box-text">
                                                <p class="title"><a class="tp_product_name" href="/product/' . htmlspecialchars($item['p_id']) . '" title="' . htmlspecialchars($item['p_name']) . '">' . htmlspecialchars($item['p_name']) . '</a></p>
                                                <p class="price">
                                                    <strong class="f-left">
                                                        <span class="tp_product_price">' . number_format($item['p_price']) . '</span>
                                                    </strong>
                                                </p>
                                                <p class="discount-percent"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                $output = '<h2 class="text-center text-secondary mt-5">Không có sản phẩm nào</h2>';
            }

            echo json_encode(array(
                'output' => $output,
            ));
        } else {
            echo json_encode(array('output' => '<h2 class="text-center text-warning mt-5">Không có sản phẩm nào</h2>'));
        }
    }

    public function addCart()
    {

        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];

            $products = $this->products->getProductToAddToCartByID($id);

            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            $cart = $_SESSION['cart'];

            if (empty($cart[$id])) {
                $cart[$id] = array(
                    'id' => $id,
                    'name' => $products[0]['p_name'],
                    'image' => $products[0]['p_image'],
                    'price' => $products[0]['p_price'],
                    'quantity' => $quantity
                );
            } else {
                // Tăng số lượng sản phẩm nếu đã tồn tại trong giỏ hàng
                $cart[$id]['quantity'] += $quantity; // Cộng thêm số lượng hiện tại
            }

            $_SESSION['cart'] = $cart;

            $totalQuantity = 0;
            $totalPrice = 0;

            foreach ($cart as $item) {
                $totalQuantity += (int)$item['quantity'];
                $totalPrice += (int)$item['quantity'] * (int)$item['price'];
            }

            echo $totalQuantity . "-" . number_format($totalPrice);
        }
    }

    public function AddToCart()
    {
        // Kiểm tra nếu giỏ hàng đã tồn tại trong session
        if (isset($_SESSION['cart'])) {
            // Lấy giỏ hàng từ session
            $cart = $_SESSION['cart'];
        } else {
            // Nếu chưa có giỏ hàng, khởi tạo một giỏ hàng mới (mảng rỗng)
            $cart = [];
        }

        // Thêm sản phẩm vào giỏ hàng
        // (Thay thế bằng logic của bạn để thêm sản phẩm cụ thể)
        // Ví dụ: $cart[] = $newProduct;

        // Lưu giỏ hàng trở lại session
        $_SESSION['cart'] = $cart;

        // Hiển thị view với giỏ hàng
        $this->renderViewsClient($this->fodel . __FUNCTION__, [
            'cart' => $cart
        ]);
    }

    public function deleCart()
    {
        if (isset($_POST['id']) && isset($_POST['quantity'])) {

            $id = $_POST['id'];

            $quantity = intval($_POST['quantity']); // chuyển thành số nguyên

            if ($quantity >= 0) {
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    if (array_key_exists($id, $cart)) {
                        if ($quantity > 0) {
                            $cart[$id] = array(
                                'id' => $cart[$id]['id'],
                                'name' => $cart[$id]['name'],
                                'image' => $cart[$id]['image'],
                                'price' => $cart[$id]['price'],
                                'quantity' => $cart[$id]['quantity']
                            );
                        } else {
                            unset($cart[$id]);
                        }
                        $_SESSION['cart'] = $cart;
                    }
                }
            }
        }
    }
}
