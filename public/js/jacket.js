/**
 * Grizzly.
 * @author: kreeck
 * Date: 10/6/13
 * Time: 9:34 PM
 */
$( function () {
    $('.jacketItem > span' ).click(function(){
        $('.jacketItem' ).addClass('collapsed');
        $(this ).parent('section').removeClass('collapsed');
    });
} );