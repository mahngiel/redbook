/**
 * Grizzly.
 * @author: kreeck
 * Date: 10/11/13
 * Time: 11:18 PM
 */
Modernizr.load( [
    {
        test: Modernizr.history,
        yep : Redbook.asset_url + 'js/history.js'
    },
    {
        test:Modernizr.canvas,
        yep: Redbook.asset_url + 'js/vendor/chart.min.js'
    }
] );
