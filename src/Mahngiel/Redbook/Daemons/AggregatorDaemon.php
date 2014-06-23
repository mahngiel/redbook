<?php namespace Mahngiel\Redbook\Daemons;

use Mahngiel\Daemon\DaemonChild;

class AggregatorDaemon extends DaemonChild {

    /**
     * @var string
     */
    protected $pidFile = 'daemon-aggregator.pid';

    /**
     * @var string
     */
    protected $logError = "aggregator-error.log";

    /**
     * @var string
     */
    protected $logRunning = "aggregator.log";

    protected $interval = 10;

    private $seriesIds;

    private $counter = 0;
    private $db;

    /**
     *
     */
    public function __construct()
    {
        $this->daemonFile = __FILE__;

        $this->daemonFileHash = md5_file( $this->daemonFile );

        parent::__construct();
    }

    /**
     *
     */
    public function start()
    {
//        parent::start();

        while ($this->daemonCanRun())
        {
            $this->run();

            sleep( $this->getInterval() );
        }
    }

    /**
     *
     */
    public function run()
    {
//        parent::run();

        if( $this->db === null )
        {
            $this->reconnect();
        }

        $this->db->info();
    }

    public function reconnect( )
    {

        // Reconnect to the database
        $Database = new \Illuminate\Redis\Database( \Config::get( 'redbook::database.redis' ) );

        $this->db = $Database->connection( 'redbook' );

    }

}
