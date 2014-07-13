<div class="pure-g">
    <div id="redbook-nav" class="pure-u-1">
        <div class="nav-inner">
            <div class="pure-menu pure-menu-open">
                <ul>
                    <li class="pure-menu-heading">Databases</li>
                    @foreach( $databases as $databaseOption )
                    <li
                    {{ \Session::get('activeDatabase') == $databaseOption ? 'class="active"' : '' }}>
                            <a class="changeSchema" href="{{ REDBOOK_URI . 'database/'. $databaseOption }}">
                                <i class="fa fa-database fa-fw"></i>
                                {{ $databaseOption }}
                            </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="redbook-schema" class="pure-u-1">
        @include( MODULE .'schema')
    </div>
</div>
