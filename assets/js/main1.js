document.addEventListener('DOMContentLoaded', function () {
    var sizeLinks = document.querySelectorAll('.size-link');
    var addToCartBtn = document.getElementById('add-to-cart-btn');
    var buyNowBtn = document.getElementById('buy-now-btn');

    sizeLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

            // Loại bỏ class "active" từ tất cả các thẻ <a>
            sizeLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Thêm class "active" vào thẻ <a> được click
            this.classList.add('active');

            // Enable các nút "Thêm vào giỏ hàng" và "Mua ngay"
            addToCartBtn.disabled = false;
            buyNowBtn.disabled = false;

            // Thay đổi thuộc tính title để hiển thị thông báo mới
            addToCartBtn.title = "Thêm vào giỏ hàng";
            buyNowBtn.title = "Mua ngay";
        });
    });

    var quantityInput = document.getElementById('quantity');
    var numberMinus = document.querySelector('.number-down');
    var numberPlus = document.querySelector('.number-up');

    // Sự kiện click cho nút giảm số lượng
    numberMinus.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > parseInt(quantityInput.min)) {
            quantityInput.value = currentValue - 1;
           
        }
    });

    // Sự kiện click cho nút tăng số lượng
    numberPlus.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value);
        if (currentValue < parseInt(quantityInput.max)) {
            quantityInput.value = currentValue + 1;
           
        }
    });

    // Sự kiện thay đổi giá trị trong ô input
    quantityInput.addEventListener('change', function () {
        var currentValue = parseInt(quantityInput.value);
        var minValue = parseInt(quantityInput.min);
        var maxValue = parseInt(quantityInput.max);

        if (currentValue < minValue) {
            quantityInput.value = minValue;
        } else if (currentValue > maxValue) {
            quantityInput.value = maxValue;
        }
    });

   function totalQuantity() {
      parseInt(quantityInput.value)
   }
});
