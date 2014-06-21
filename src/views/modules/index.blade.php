<div class="pure-g">
    <div id="redbook-nav" class="pure-u-1">
        <div class="nav-inner">
            <div class="pure-menu pure-menu-open">
                <ul>
                    <li class="pure-menu-heading">Databases</li>
                    @foreach( $databases as $databaseOption )
                        <li>
                            <a class="changeSchema" href="{{ REDBOOK_URI . 'database/'. $databaseOption }}"><i class="fa fa-database"></i> {{ $databaseOption }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="redbook-schema" class="pure-u-1">
        <div id="redbook-schema-tree">
            {{ makeRedisSchemaTree( $Objects ) }}
        </div>
    </div>
</div>
