$(document).ready(function () {
    // Định nghĩa hàm addcart
    function addcart(id, quantity, idSize, nameSize) {
        $.post("/product/add_cart", {
            'id': id,
            'idSize': idSize,
            'nameSize': nameSize,
            'quantity': quantity
        }, function (data) {
            item = data.split("-");
            $('.count').text(item[0])
        });
    }

    // Định nghĩa hàm totalQuantity
    function totalQuantity() {
        return parseInt($('#quantity').val());
    }

    // Kích hoạt sự kiện cho nút thêm vào giỏ hàng
    $('#add-to-cart-btn').click(function () {
        var productId = $('#product-info').data('product-id');
        var quantity = totalQuantity();
        var idSize = $('.size-link.active').data('value'); // Đảm bảo rằng kích thước được chọn có class 'active'
        var nameSize = $('.size-link.active').data('name'); // Đảm bảo rằng kích thước được chọn có class 'active'

        addcart(productId, quantity, idSize, nameSize);
    });

    // Kích hoạt sự kiện cho các liên kết chọn kích thước
    $('.size-link').click(function (e) {
        e.preventDefault();
        $('.size-link').removeClass('active');
        $(this).addClass('active');
    });


});