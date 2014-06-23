<?php namespace Mahngiel\Redbook\Daemons;

if (\Clio\Daemon::isRunning( \Config::get( 'redbook::redbook.daemonPath' ) . 'rnd.pid' ))
{
    echo "daemon is running";
}
else
{
    \Clio\Daemon::work( array(
            'pid' => \Config::get( 'redbook::redbook.daemonPath' ) . 'rnd.pid'
        ),
        function ( $stdIn, $stdOut, $stdErr )
        {
            $Database = new \Illuminate\Redis\Database( \Config::get( 'redbook::database.redis' ) );

            $r = $Database->connection( 'redbook' );


            while (true)
            {

                echo $stdIn . "\n";

                sleep( 1 );
            }
        }
    );

    echo "daemon is running";
}
