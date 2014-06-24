@include( PACKAGE . 'types._titlebar', array('Object'=>$Object) )

<div id="definition">
    <table class="pure-table pure-table-striped">
        <thead>
            <tr>
                <th>field</th>
                <th>value</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $Object['value'] as $field => $value )
                <tr>
                    <td>{{ $field }}</td>
                    <td class="editable" data-key="{{ $field }}">{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
