<div class="pure-g">
    <div id="redbook-nav" class="pure-u-1">
        <div class="nav-inner">
            <div class="pure-menu pure-menu-open">
                <ul id="redbook-databases">
                    <li class="pure-menu-heading">Databases</li>
                    <?php foreach( $databases as $databaseOption ): ?>
                        <li <?php echo \Session::get('activeDatabase') == $databaseOption ? 'class="active"' : '' ;?>>
                            <a class="changeSchema" href="<?php echo REDBOOK_URI . 'database/'. $databaseOption ;?>">
                                <i class="fa fa-database fa-fw"></i>
                                <?php echo $databaseOption ;?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div id="redbook-schema" class="pure-u-1">
        @include( MODULE .'schema')
    </div>
</div>
