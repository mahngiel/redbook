<?php

/**
 * Redbook configurations
 */
return array(
    'routeIndex'      => '/redbook',
    'schemaSeparator' => ':',
    'daemonPath'      => storage_path( 'logs/daemons/' ),
    'treeViewer'      => '\\Mahngiel\\Redbook\\Markup\\RedbookPresentation'
);
