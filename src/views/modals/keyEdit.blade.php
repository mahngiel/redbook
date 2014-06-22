<div class="modal-header">
    <button type="button" class="pure-button pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title" id="myModalLabel">
        <i class="fa fa-key"></i> Editing {{ $keyName }} on {{ $database }}
    </h4>
</div>

{{ Form::open(array('url'=>REDBOOK_URI.'/key', 'method'=>'POST', 'role'=>'form', 'class'=>'') )}}

    <div class="modal-body">
        <div class="">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} has-feedback">
                <label for="name" class="">New Key Value</label>

                {{ Form::text('name', $keyValue, array('class'=>'form-control ' . ($errors->has('name') ? ' error':'')) ) }}

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="pure-button alert-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="pure-button" id="sB">Create</button>
    </div>

{{ Form::close() }}
