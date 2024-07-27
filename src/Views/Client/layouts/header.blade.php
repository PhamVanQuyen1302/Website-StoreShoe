<div class="header-top wrap-flex-align">
    <div class="wrap-logo hidden-xs hidden-sm">
        <a href="/" title="Logo">
            <img style="max-width: 200px" alt="Logo" src="../../assets/img/nhanh (1).png" />
        </a>
    </div>
    <div class="hidden-xs hidden-sm">
        <div id="nav-menu">
            <nav role="navigation" class="main-nav-menu">
                @php
                    $categories = (new \App\StoreShoe\Models\Categories())->getAll();
                @endphp
                <ul class="menu__list menu__list--top tp_menu">
                    <li class="menu__item mega tp_menu_item"><a href="/" title="Trang chủ"
                            class="menu__link">Trang chủ</a></li>
                    @foreach ($categories as $item)
                        <li class="menu__item mega tp_menu_item">
                            <a href="/filter_data/{{ $item['id'] }}" title="Giày Adidas"
                                class="menu__link">{{ $item['name'] }}</a>
                        </li>
                    @endforeach

                    <li class="menu__item mega tp_menu_item"><a href="/tin-tuc" title="Tin tức chung"
                            class="menu__link">Tin tức chung</a></li>
                    <li class="menu__item mega tp_menu_item"><a href="/lien-he" title="Liên hệ" class="menu__link">Liên
                            hệ</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="header-wrap-icon">
        <div class="search-box hidden-sm hidden-xs wpo-wrapper-search hidden">
            <form action="/search" class="searchform searchform-categoris ultimate-search navbar-form">

                <div class="wpo-search-inner form-group">
                    <input name="q" maxlength="40" autocomplete="off"
                        class="searchinput input-search search-input" type="text" size="20"
                        placeholder="Tìm kiếm sản phẩm">

                </div>
                <button type="submit" class="icon-search btn">
                    <span class="search-menu" aria-hidden="true">
                        <img src="https://web.nvnstatic.net/tp/T0320/img/icon-header-3.png?v=3" alt="cart">
                    </span>
                </button>
            </form>
        </div>
        <div class="group-icon">
            <div class="col-sm-12 col-xs-12 hidden-lg hidden-md header_mobile">
                <div class="row">
                    <div class="col-sm-4 col-xs-3 group-icon iconLogo">
                        <img src="https://web.nvnstatic.net/tp/T0320/img/menu-bar.png?v=3" alt="menu bar">
                    </div>
                    <div class="col-sm-4 col-xs-6" style="text-align: center;">
                        <div class="wrap-logo">
                            <a href="/" title="Logo">
                                <img style="max-width: 130px" alt="Logo" src="/img/nhanh.png" />
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-3 group-icon iconSearch">
                        <span id="site-cart-handle" class="icon-cart" aria-label="Open cart" title="Giỏ hàng">
                            <a href="/cart">
                                @php
                                    $quantity = 0;
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                        foreach ($cart as $key) {
                                            $quantity += intval($key['quantity']);
                                        }
                                    }
                                @endphp
                                <span class="cart-menu" aria-hidden="true">
                                    <span class="count-holder" id="count-holder">
                                        <span class="count">{{ $quantity }}</span>
                                    </span>
                                </span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
