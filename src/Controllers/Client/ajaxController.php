<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Categories;
use App\StoreShoe\Models\Products;

class AjaxController extends Controller
{
    private Products $products;
    private Categories $categories;

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

    public function addToCart() {
        
    }
}
