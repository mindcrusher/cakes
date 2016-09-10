/**
 * Created by Ivan on 05.09.2016.
 */
$(function () {
    $('#update-cart').click(function () {
        $('#cart').attr('action', '/cart/update').submit();
        return false;
    });

    $('#order-cart').click(function () {
        $('#customer').toggle(100);
    });
})