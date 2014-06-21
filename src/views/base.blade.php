<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A layout example that shows off a responsive email layout.">

        <title>Email &ndash; Layout Examples &ndash; Pure</title>
        <script type="text/javascript">
            Redbook = [];
            Redbook.base_url = '<?php echo Request::getSchemeAndHttpHost() .'/'. REDBOOK_URI ?>';
            Redbook.asset_url = '<?php echo ASSET_URL; ?>';
        </script>
        {{ Colophon::getHeadScripts() }}
        {{ Colophon::getStylesheets() }}
    </head>
    <body>
        <div id="layout" class="content pure-g">

            {{-- Modules::getModuleArea('sidebar') --}}

            <div id="main" class="pure-u-1">
                <div class="email-content">
                    <div class="email-content-header pure-g">
                        <div class="pure-u-1-2">
                            <h1 class="email-content-title">Hello from Toronto</h1>

                            <p class="email-content-subtitle">
                                From <a>Tilo Mitra</a> at <span>3:56pm, April 3, 2012</span>
                            </p>
                        </div>

                        <div class="email-content-controls pure-u-1-2">
                            <button class="secondary-button pure-button">Reply</button>
                            <button class="secondary-button pure-button">Forward</button>
                            <button class="secondary-button pure-button">Move to</button>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="twelve columns">
                        {{ isset($content) ? $content : '' }}
                    </div>
                </div>
            </div>
        </div>
        @section('footer_scripts')
            {{ Colophon::getFooterScripts() }}
            <script>
                YUI().use( 'node-base', 'node-event-delegate', function ( Y ) {
                    // This just makes sure that the href="#" attached to the <a> elements
                    // don't scroll you back up the page.
                    Y.one( 'body' ).delegate( 'click', function ( e ) {
                        e.preventDefault();
                    }, 'a[href="#"]' );
                } );

                YUI().use('node-load', function(Y){
                    Y.all('.key' ).on('click', function(){
                        console.log( )
                    });
                });
            </script>
        @show
    </body>
</html>
