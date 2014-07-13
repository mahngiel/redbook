/**
 * Redbook.
 * @author: kreeck
 * Date: 7/12/14
 * Time: 9:16 PM
 */

//Self-Executing Anonymous Function: Part 2 (Public & Private)
(function ( Redbook, $, undefined ) {

    //Private Property
    var isHot = true;
    //Public Property
    Redbook.ingredient = "Bacon Strips";

    //Public Method
    Redbook.fry = function () {
        var oliveOil;

        addItem( "\t\n Butter \n\t" );
        addItem( oliveOil );
        console.log( "Frying " + Redbook.ingredient );
    };

    //Private Method
    function addItem( item ) {
        if ( item !== undefined ) {
            console.log( "Adding " + $.trim( item ) );
        }
    }

}( window.Redbook = window.Redbook || {}, jQuery ));
