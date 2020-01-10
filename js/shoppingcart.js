disableShoppinCart = false;
$(document).ready(function () {

    $(document).on('click', '.min', function (e) {
        product_id = $(this).data('id');
        console.log(product_id);
        $.get("../files/functions/winkelmandVerschil.php?sub=" + product_id, function (data) {

            if (data == 0) {

                $('.overview .item[data-id="' + product_id + '"]').remove();

                if ($('.overview .cart_item').length == 0) {
                    if ($('.overview .no_products').length == 0) {
                        $('.shoppingcart .overview').append('<div class="item no_products">Nog geen producten toegevoegd!</div>');
                    }
                    $('.shoppingcart .overview .checkout').remove();
                }

            }
            updateAmount(product_id, data);

        });
    });

    $(document).on('click', '.plus', function (e) {
        product_id = $(this).data('id');
        console.log(product_id);
        $.get("../files/functions/winkelmandVerschil.php?add=" + product_id, function (data) {
            if (data == 1) {
                var product = $('.product[data-id="' + product_id + '"]');
                var product_image = product.find('.product_image').attr('src');
                var product_name = product.find('.product_name').text();
                var product_price = product.find('.product_price').text();
                var html_elem = '<div class="item cart_item" data-id="' + product_id + '"><img src="' + product_image + '" class="product_image"/><div class="product_info"> <div class="current_amount" data-id="' + product_id + '"> <div class="amount_container"><span class="amount">1</span><span class="times"> x </span></div><span class="price"> &euro; <span class="product_price">' + product_price + '</span></span></div><span>' + product_name + ' </span><div class="quantity_change"><img src="/images/plus.jpg" alt="plus" class="plus cart_disable" data-id="' + product_id + '"/><img src="/images/min.jpg" alt="plus" class="min cart_disable" data-id="' + product_id + '"/></div></div></div>';

                $('.overview').prepend(html_elem);
                if ($('.overview .cart_item').length == 1) {
                    $('.no_products').remove();
                    if ($('.overview .checkout').length == 0) {
                        $('.shoppingcart .overview').append('<div class="checkout"><button class="checkout_button">checkout</button></div>');
                    }
                }
            }
            updateAmount(product_id, data);
        });

    });

    function updateAmount(product_id, amount) {
        $('.current_amount[data-id="' + product_id + '"] .amount').html(amount);

    }

    $(document).on('click', '.checkout_button', function () {
        window.location = '/checkout';
    });

    if (disableShoppinCart === true) {
        $(".winkelmandje").remove();
    }
});