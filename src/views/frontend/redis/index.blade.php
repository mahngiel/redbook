<div id="page-title">
    <h3>Redis Databases Dataset</h3>
</div>

@if( isset($Objects) )
    @foreach( $Objects as $Key => $Values )
        <table class="">
            <thead>
                <tr class="bg-primary">
                    <td colspan="2" class="aleft bold">{{ $Key }}</td>
                </tr>
            </thead>
            @foreach( $Values as $k => $v )
                <tr>
                    <td>{{ $k }}</td>
                    <td>{{ !is_array($v) ? $v : json_encode($v) }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
@else
    <p>{{ $Alert }}</p>
@endif
