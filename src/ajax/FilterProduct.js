$(document).ready(function () {
    function filterProducts() {
        var action = 'filter_data';
        var priceFrom = $('#price_form').data('size');
        var priceTo = $('#price_to').data('size');
        var sizes = get_filter('sizes');

        var href = new URL(window.location.href);
        var id = href.pathname.split('/').pop();

        var urlApi = '/filter_data'
            '?action=' + action +
            '&id=' + id +
            '&price_from=' + priceFrom +
            '&price_to=' + priceTo +
            '&sizes=' + sizes.join(',');
        $.ajax({
            url: urlApi,
            method: 'GET',
            data: {
                action: action,
                id: id,
                priceFrom: priceFrom,
                priceTo: priceTo,
                sizes: sizes
            },
            success: function (data) {
                try {
                    var jsonData = JSON.parse(data);
                        $('#resultAjax').html(jsonData.output);
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Có lỗi xảy ra:', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('#slider-range').on('slidechange', function (event, ui) {
        $('#price_form').data('size', ui.values[0]);
        $('#price_to').data('size', ui.values[1]);
        filterProducts();
    });

    $('.sizes').on('change', function () {
        filterProducts();
    });

    $('.tp_product_category_filter_attribute .tag-choise').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        filterProducts();
    });

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 5000000,
        step: 10000,
        values: [0, 5000000],
        slide: function (event, ui) {
            $("#price_form").text(ui.values[0] + 'đ');
            $("#price_to").text(ui.values[1] + 'đ');
        },
        change: function (event, ui) {
            $('#price_form').data('size', ui.values[0]);
            $('#price_to').data('size', ui.values[1]);
            filterProducts();
        }
    });
});
