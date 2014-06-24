<div id="page-title">
    <div id="key-type">{{ $Object['type'] }}</div>
    <div id="key-name"><i class="fa fa-key fa-fw"></i> {{ $Object['name'] }}</div>
    <div id="key-options" data-database="{{ \Session::get('activeDatabase') }}" data-key="{{ $Object['name'] }}" data-ttl="{{ $Object['ttl'] }}">
        <a class="makeEditable" href="#" title="Edit Key"> <i class="fa fa-pencil"></i> </a>
        <a href="#" title="Rename Key"><i class="fa fa-filter"></i></a>
        <a href="#" title="Edit TTL for Key"><i class="fa fa-clock-o"></i></a>
        <a class="ajaxDelete" href="{{ REDBOOK_URI }}key.delete" title="Remove Key"><i class="fa fa-trash-o"></i></a>
    </div>
</div>
