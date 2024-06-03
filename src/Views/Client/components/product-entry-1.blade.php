<div class="item col-lg-3 col-md-4 col-xs-6 col-sm-6">
    <div class="inner-item sold-out product-item" data-id="37834087"
        data-img="{{ $item['p_image'] }}">
        <div class="p-image">
            <a class="a-image" href="/product/{{ $item['p_id'] }}">
                <img data-sizes="auto" src="{{ $item['p_image'] }}"
                    data-src="{{ $item['p_image'] }}"
                    class="attachment-medium size-medium wp-post-image lazyload productHover productHover37834087"
                    alt="Giày Nike Air Force 1 Shadow SE Women’s “Solar Red” DB3902-100" />
            </a>
            <div class="btn-quickview tp_button">
                <i class="fal fa-eye"></i>
                <span>
                    <a href="/product/{{ $item['p_id'] }}"> Xem Ngay</a>
                </span>
            </div>
        </div>
        <div class="box-text">
            <p class="title"><a class="tp_product_name" href="/product/{{ $item['p_id'] }}"
                    title="{{ $item['p_name'] }}">{{ $item['p_name'] }}</a>
            </p>

            <p class="price">
                <strong class="f-left">
                    <span class="tp_product_price">{{ number_format($item['p_price']) }}</span>
                </strong>
            </p>
            <p class="discount-percent"></p>
        </div>

    </div>  
</div>
