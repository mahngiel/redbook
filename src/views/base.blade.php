<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A layout example that shows off a responsive email layout.">

        <title>Redbook: A Redis&reg; Schema Visualizer</title>
        <script type="text/javascript">
            var Redbook = {
                name: '<?php echo Colophon::getAppName(); ?>',
                baseUrl: '<?php echo Request::getSchemeAndHttpHost() . REDBOOK_URI ?>',
                assetUrl: '<?php echo ASSET_URL; ?>'
            };
        </script>
        {{ Colophon::getHeadScripts() }}
        {{ Colophon::getStylesheets() }}
    </head>
    <body>
        <div id="redbook-header">
            <div id="redbook-identity"><a href="{{ REDBOOK_URI }}">{{ Colophon::getAppName() }}</a></div>
        </div>

        <div id="redbook" class="pure-g">

            {{-- Sidebars --}}
            <div class="pure-u-2-5 pure-u-md-1-3">
                {{ Modules::getModuleArea('sidebar') }}
            </div>

            {{-- Main Content --}}
            <div id="redbook-main" class="pure-u-3-5 pure-u-md-2-3">

                <div class="pure-g">

                    {{-- Content --}}
                    <div class="pure-u-1">
                        <div id="page">
                            {{ isset($content) ? $content : '' }}
                        </div>
                    </div>

                    {{-- Console --}}
                    <div class="pure-u-1">
                        {{ Modules::getModule('console') }}
                    </div>

                </div>

            </div>
        </div>
        @section('footer_scripts')
            {{ Colophon::getFooterScripts() }}
        @show
    </body>
</html>
