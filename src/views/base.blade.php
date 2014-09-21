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
        <div id="redbookBody">
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

                        <!-- Databases -->
                        <div id="redbook-nav"       class="columns large-2 medium-2" ng-controller="DatabaseController as dbCtrl">
                            <ul class="side-nav">
                                <li>Databases</li>
                                <li ng-show="loading"><i class="fa fa-spinner fa-spin"></i>loading</li>
                                <li ng-repeat="database in databases" ng-class="{ active:database.active === 1 }" ng-hide="loading">
                                    <a class="changeSchema" ng-href="<?php echo REDBOOK_URI; ?>databases/@{{ database.name }}">
                                        <i class="fa fa-database fa-fw"></i>
                                        @{{ database.name }}
                                    </a>
                                </li>
                                <li>
                                    <a ng-href="<?php echo REDBOOK_URI; ?>databases/create" ng-click="content = 3">
                                        <i class="fa fa-plus-square"></i> create
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- Schemae --}}
                        <div id="redbook-schema"    class="columns large-4 medium-3 small-5" ng-controller="DatabaseController as dbCtrl" ng-bind-html=" activeDatabaseSchema | trustedHtml"> </div>

                        {{-- Body --}}
                        <div id="redbook-main"      class="columns large-6 medium-7 small-7" ng-bind-html="pageContent | trustedHtml"></div>

                    </section>

                    <a class="exit-off-canvas"></a>
                </div>
            </div>
        </div>

        @section('footer_scripts')
            <?php echo Colophon::getFooterScripts(); ?>
            <script>$(document).foundation();</script>
        @show
    </body>
</html>
