<div id="page-title">
    <h3><small>schema</small> {{ $schema }}</h3>
</div>
@if( !empty( $Objects ) )

    @foreach( $Objects as $snippet )
        {{ $snippet }}
    @endforeach

@else
    <p>Schema returned empty results</p>
@endif
