<div id="page-title">
    Create a database entry
</div>

<form ng-controller="DatabaseController as DbCtrl" ng-submit="DbCtrl.addDatabase" role="form" class="pure-form pure-form-stacked" novalidate="novalidate">

    <fieldset>

        <?php if ( !empty($error) ): ?>
            <label for="force" class="pure-checkbox">
                <input name="force" id="force" type="checkbox" ng-model="DbCtrl.database.force" /> <?php echo $error; ?>
            </label>
        <?php endif; ?>

        <div class="pure-control-group">
            <label for="name" class="">Database Name</label>
            <input type="text" value="" id="name" name="name" class="pure-u-1" ng-model="DbCtrl.database.name" required/>
            <span class="">create a unique name for this database</span>
        </div>

        <div class="pure-control-group">
            <label for="host" class="">Database Address</label>
            <input type="text" value="127.0.0.1" id="host" name="host" class="pure-u-1" ng-model="DbCtrl.database.host" required/>
            <span class="">connection address for database</span>
        </div>

        <div class="pure-control-group">
            <label for="port" class="">Database Port</label>
            <input type="text" value="6379" id="port" name="port" class="pure-u-1" ng-model="DbCtrl.database.port" required/>
            <span class="">database port</span>
        </div>

        <div class="pure-control-group">
            <label for="password" class="">Database Password</label>
            <input type="text" value="" id="password" name="password" class="pure-u-1" autocomplete="off" ng-model="DbCtrl.database.password" />
            <span class="">this value will be written to a local file in plain text</span>
        </div>

        <div class="pure-control-group">
            <label for="database" class="">Database Number</label>
            <input type="text" value="0" id="database" name="database" class="pure-u-1" ng-model="DbCtrl.database.database" required/>
            <span class="">connection database number</span>
        </div>

        <div class="pure-control-group">
            <label for="namespace" class="">Namespace Separator</label>
            <input type="text" value=":" id="namespace" name="namespace" class="pure-u-1" ng-model="DbCtrl.database.namespace"/>
            <span class="">standard key storage separator</span>
        </div>

        <div>validation: {{reviewForm.$valid}} </div>
        <button class="pure-button pure-button-primary" type="submit">Create new database</button>

    </fieldset>
</form>
