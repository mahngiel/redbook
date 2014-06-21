<div id="page-title">
    <h3>Redis Keystores</h3>
</div>

<table class="pure-table pure-table-bordered">
    <thead>
        <tr class="bg-primary">
            <th>Key Name (type)</th>
            <th>Key Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $Objects as $Object )
            <tr>
                <td>{{ $Object['name'] }} <strong class="text-muted pull-right">({{ $Object['type'] }})</strong></td>
                <td class="truncate" style="">{{ $Object['value'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
