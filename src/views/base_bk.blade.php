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
        <div class="fixed">
            <nav class="top-bar" data-topbar role="navigation" data-options="is_hover: false">
                <ul class="title-area">
                    <li class="name">
                        <h1><a href="<?php echo REDBOOK_URI; ?>"><?php echo Colophon::getAppName(); ?></a></h1>
                    </li>
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>

                <section class="top-bar-section">
                    <!-- Right Nav Section -->
                    <ul class="right">
                        <li class="divider"></li>
                        <li class=""><a href="#">Config</a></li>
                    </ul>

                    <!-- Left Nav Section -->
                    <ul class="left">
                        <li><a href="#">Home</a></li>
                    </ul>
                </section>
            </nav>
        </div>

        <div id="redbook" class="pure-g row">

            <div class="pure-u-2-5 pure-u-md-1-3 columns large-4" ng-controller="DatabaseController as dbCtrl">
                <div class="pure-g">
                    <div id="redbook-nav" class="pure-u-1">

                        <div class="nav-inner">
                            <div class="pure-menu pure-menu-open">
                                <ul id="redbook-databases">
                                    <li class="pure-menu-heading"> Databases</li>
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
                                    <li>&nbsp;</li>
                                </ul>
                            </div>
                        </div>

                        <div class="nav-inner">
                            <div class="pure-menu pure-menu-open">
                                <ul id="redbook-databases">
                                    <li class="pure-menu-heading">Configs</li>
                                    <li class="">
                                        <a href="<?php echo REDBOOK_URI; ?>config/global" class="ajaxLink" target="page">Global</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="redbook-schema" class="pure-u-1" ng-bind-html=" activeDatabaseSchema | trustedHtml"></div>
                </div>
            </div>

            <div id="redbook-main" class="pure-u-3-5 pure-u-md-2-3 columns large-8">

                <div class="pure-g">

                    <div class="pure-u-1">
                        <div id="page" ng-bind-html="pageContent | trustedHtml"></div>
                    </div>

                    <div class="pure-u-1">
                        <?php /*echo Modules::getModule( 'console' );*/ ?>
                    </div>

                </div>

            </div>
        </div>
        @section('footer_scripts')
            <?php echo Colophon::getFooterScripts(); ?>
        @show
    </body>
</html>
