<div id="page-title">
    <i class="fa fa-gears"></i> Redbook global configuration
</div>

<form action="<?php echo REDBOOK_URI; ?>config/global" method="POST" class="pure-form pure-form-stacked" role="form">
    <fieldset >

        <?php foreach ($configs as $configKey => $configValue): ?>
            <div class="pure-control-group">
                <label for="<?php echo $configKey; ?>" class=""><?php echo $configKey; ?></label>

                <input type="text" value="<?php echo $configValue; ?>" id="<?php echo $configKey; ?>" name="<?php echo $configKey; ?>" class="pure-u-1" />

            </div>
        <?php endforeach; ?>

        <button class="pure-button pure-button-primary submit" type="submit">Save configuration</button>

    </fieldset>

</form>
