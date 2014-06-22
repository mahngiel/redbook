<div id="redbook-schema-database">
    {{ HTML::link(REDBOOK_URI, \Session::get('activeDatabase', 'default') . ' overview' ) }}
</div>
<div id="redbook-schema-tree">
    {{ makeRedisSchemaTree( $Objects ) }}
</div>
