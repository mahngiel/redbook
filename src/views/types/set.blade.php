@include( PACKAGE . 'types._titlebar', array('Object'=>$Object) )

<div id="definition">
    @foreach( $Object['value'] as $value )
        <div class="editable">{{ $value }}</div>
    @endforeach
</div>
