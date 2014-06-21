<div id="nav" class="pure-u">
    <div class="nav-inner">
        <div class="pure-menu pure-menu-open">
            <ul>
                <li class="pure-menu-heading">Databases</li>
                @foreach( $databases as $databaseOption )
                    <li><a href="{{ REDBOOK_URI . '?database='. $databaseOption }}"><i class="fa fa-database"></i> {{ $databaseOption }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div id="list" class="pure-u-1">
    {{ makeRedisSchemaTree( $Objects ) }}
</div>
