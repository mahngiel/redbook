@if( !empty( $Object ) )
    <div id="page-title">
        <h3><small>{{ $Object['type'] }}</small>{{ $Object['name'] }}</h3>
    </div>

    <div id="definition">
        {{ generateHtmlSnippet($Object) }}
    </div>
@else
    <div id="page-title">
        <h3>Query Exception</h3>
    </div>

    <p>{{ $error }}</p>
@endif
