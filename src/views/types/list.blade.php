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
            @foreach( $Object['value'] as $index => $value )
                <tr>
                    <td>{{ $index }}</td>
                    <td class="editable" data-key="{{ $index }}">{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
