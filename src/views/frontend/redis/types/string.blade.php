<div id="page-title">
    <div id="key-type">{{ $Object['type'] }}</div>
    <div id="key-name"><i class="fa fa-key fa-fw"></i> {{ $Object['name'] }}</div>
    <div id="key-options">
        <a href="#" title="Edit Key"><i class="fa fa-pencil"></i></a>
        <a href="#" title="Remove Key"><i class="fa fa-trash-o"></i></a>
        <a href="#" title="Rename Key"><i class="fa fa-filter"></i></a>
        <a href="#" title="Set TTL for Key"><i class="fa fa-clock-o"></i></a>
    </div>
</div>

<div id="definition">
    {{ generateHtmlSnippet($Object) }}
</div>
