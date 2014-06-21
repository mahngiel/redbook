<div id="page-title">
    <h3>{{ $Object['name'] }}</h3>
</div>

<table class="table table-bordered table-condensed table-hover small">
    <thead>
        <tr class="bg-primary">
            <th>Key Name (type)</th>
            <th>Key Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $Object['name'] }} <strong class="text-muted pull-right">({{ $Object['type'] }})</strong></td>
            <td class="truncate" style="">{{ $Object['value'] }}</td>
        </tr>
    </tbody>
</table>
