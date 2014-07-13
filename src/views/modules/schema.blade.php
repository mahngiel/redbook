<div id="redbook-schema-database">
    {{ HTML::link(REDBOOK_URI, \Session::get('activeDatabase', 'default') . ' overview' ) }}
</div>
<div id="redbook-schema-tree">
    <div id="redbook-schema-filter">
        <input name="schemaSearch" type="text" id="schemaSearch" class="form-control" placeholder="search schema"/>
    </div>
    {{ $Object->generateTreeHtml() }}
</div>
