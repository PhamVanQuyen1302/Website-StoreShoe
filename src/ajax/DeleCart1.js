$(document).ready(function () {
    function deleCart(id) {
        $.post("/product/dele_cart", {
            'id': id,
            'quantity': 0
        }, function (data) {
            console.log(11111111111111);
            $('#count-holder').load('/cart #count-holder');
            $('#page_cart').load('/cart #page_cart');
        });
    }

    $('#dele-cart').click(function () {
        var id = $('#dele-cart').data('id');
        deleCart(id);

    });
});