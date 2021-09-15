//Plus & Minus for Quantity product
$(document).ready(function () {
    var quantity = 1;

    $('.quantity-right-plus').click(function (e) {
        e.preventDefault();
        quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

    $('.quantity-left-minus').click(function (e) {
        e.preventDefault();
        quantity = parseInt($('#quantity').val());
        if (quantity > 1) {
            $('#quantity').val(quantity - 1);
        }
    });
});