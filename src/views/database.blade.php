<div id="page-title">
    <h3><i class="fa fa-database"></i> Redis Keystores</h3>
</div>

<div id="definition">
    <?php if( isset($Database) ): ?>
        <?php foreach( $Database as $Key => $Values ): ?>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <td colspan="2" class="aleft bold"><?php echo $Key;?></td>
                    </tr>
                </thead>
                <?php foreach( $Values as $k => $v ): ?>
                    <tr>
                        <td><?php echo deslug($k, '_');?></td>
                        <td><?php echo !is_array($v) ? $v : json_encode($v);?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p><?php echo $Alert;?></p>
    <?php endif; ?>
</div>
