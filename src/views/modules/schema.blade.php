<div id="redbook-schema-database">
    {{ HTML::link(REDBOOK_URI, \Session::get('activeDatabase', 'default') . ' overview' ) }}
</div>
<div id="redbook-schema-tree">
    <div>
        <input name="bob" type="text" id="schemaSearch" class="form-control" placeholder="search schema"/>
    </div>
    {{ $Object->generateTreeHtml() }}
</div>
