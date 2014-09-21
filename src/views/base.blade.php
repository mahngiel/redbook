<!doctype html>
<html lang="en" ng-app="redbook" id="top">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A layout example that shows off a responsive email layout.">

        <title>Redbook: A Redis&reg; Schema Visualizer</title>
        <script type="text/javascript">
            var Redbook = {
                name    : '<?php echo Colophon::getAppName(); ?>',
                baseUrl : '<?php echo Request::getSchemeAndHttpHost() . REDBOOK_URI ?>',
                assetUrl: '<?php echo ASSET_URL; ?>'
            };
        </script>
        <?php echo Colophon::getHeadScripts(); ?>
        <?php echo Colophon::getStylesheets(); ?>
    </head>
    <body>

            <div class="off-canvas-wrap" data-offcanvas>
                <div class="inner-wrap">
                    <nav class="tab-bar">
                        <section class="left-small"> <a class="left-off-canvas-toggle menu-icon"><span></span></a> </section>
                        <section class="right tab-bar-section"> <h1 class=""><a href="<?php echo REDBOOK_URI; ?>"><?php echo Colophon::getAppName(); ?></a></h1> </section>
                        <section class="right-small"> <a class="right-off-canvas-toggle menu-icon" ><span></span></a> </section>
                    </nav>

                    <aside class="left-off-canvas-menu">
                        <ul class="off-canvas-list">
                            <li><label>Foundation</label></li>
                            <li class="has-submenu"><a href="#">The Psychohistorians</a>
                                <ul class="left-submenu">
                                    <li class="back"><a href="#">Back</a></li>
                                    <li><label>Level 1</label></li>
                                    <li><a href="#">Link 1</a></li>
                                    <li class="has-submenu"><a href="#">Link 2 w/ submenu</a>
                                        <ul class="left-submenu">
                                            <li class="back"><a href="#">Back</a></li>
                                            <li><label>Level 2</label></li>
                                            <li><a href="#">...</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">...</a></li>
                                </ul>
                            </li>
                            <li><a href="#">The Encyclopedists</a></li>
                            <li><a href="#">The Mayors</a></li>
                            <li><a href="#">The Traders</a></li>
                            <li><a href="#">The Merchant Princes</a></li>
                        </ul>
                    </aside>

                    <aside class="right-off-canvas-menu">
                        <ul class="off-canvas-list">
                            <li><label>Users</label></li>
                            <li><a href="#">Hari Seldon</a></li>
                            <li class="has-submenu"><a href="#">R. Giskard Reventlov</a>
                                <ul class="right-submenu">
                                    <li class="back"><a href="#">Back</a></li>
                                    <li><label>Level 1</label></li>
                                    <li><a href="#">Link 1</a></li>
                                    <li class="has-submenu"><a href="#">Link 2 w/ submenu</a>
                                        <ul class="right-submenu">
                                            <li class="back"><a href="#">Back</a></li>
                                            <li><label>Level 2</label></li>
                                            <li><a href="#">...</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">...</a></li>
                                </ul>
                            </li>
                            <li><a href="#">...</a></li>
                        </ul>
                    </aside>

                    <section class="main-section">

                        <div id="redbook" class="row">
                            <div class="columns large-4">
                                <div class="row">
                                    <div id="redbook-nav"  class="columns large-5">dbs</div>
                                    <div id="redbook-schema" class="columns large-7">schema</div>
                                </div>
                            </div>
                            <div id="redbook-main" class="columns large-8"> body </div>
                        </div>

                    </section>

                    <a class="exit-off-canvas"></a>
                </div>
            </div>

        @section('footer_scripts')
            <?php echo Colophon::getFooterScripts(); ?>
            <script>$(document).foundation(); $('.left-off-canvas-toggle').click(function(){ console.log('clickered'); });</script>
        @show
    </body>
</html>
