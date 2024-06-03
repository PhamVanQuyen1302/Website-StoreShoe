<?php

namespace App\StoreShoe\Controllers\Admin;
use App\StoreShoe\Commons\Controller;

class DashboardController extends Controller {
    public function index() {
        return $this->renderViewsAdmin('dashboard');
    }
}
