@include( PACKAGE . 'types._titlebar', array('Object'=>$Object) )

<div id="definition">
    <table class="pure-table pure-table-striped">
        <thead>
            <tr>
                <th>field</th>
                <th>score</th>
                <th>value</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $Object['value'] as $key => $values )
                <tr>
                    <td>{{ $key }}</td>
                    <td class="" data-key="{{ $key }}">{{ $values[1] }}</td>
                    <td class="" data-key="{{ $key }}">{{ $values[0] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
