<div id="page-title">
    <h3>Perform tasks on the data store</h3>
</div>

{{ Form::open( array('url'=>'redis/perform', 'method'=>'post', 'role'=>'form' ) ) }}

    <ul class="gridSlice">
        <li class="slice">
            <div class="icon-set-left">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="tasks[cleanDownloads]" value="1"/>
                    </label>
                </div>
            </div>
            <div class="detail"> Clean Up download keys</div>
        </li>
    </ul>

    <button type="submit" class="btn btn-primary" data-loading-text="Performing...">Perform Tasks</button>

{{ Form::close() }}
