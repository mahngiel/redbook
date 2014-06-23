<?php namespace Mahngiel\Redbook\Daemons;

use Mahngiel\Redbook\Support\RedisReader;
use Mahngiel\Daemon\DaemonChild;

/**
 * Class RedisDaemon
 *
 * This daemon creates records of redis state snapshots
 *
 * @package Mahngiel\Redbook\Daemons
 */
class RedisDaemon extends DaemonChild {

    /**
     * @var string
     */
    protected $pidFile = 'daemon-redis.pid';

    /**
     * @var string
     */
    protected $logError = "redis-error.log";

    /**
     * @var string
     */
    protected $logRunning = "redis.log";

    /**
     * @var string name of the daemon
     */
    protected $daemonName = 'Redis';

    /**
     * @var int
     */
    protected $interval = 3600;

    /**
     * @var
     */
    private $data;

    /**
     * @var
     */
    private $Reader;

    /**
     * Define the keys we want to obtain
     *
     * @var array
     */
    private $usefulStatistics = array(
        'Server'      => array(
            'uptime_in_seconds',
        ),
        'Clients'     => array(
            'connected_clients',
            'blocked_clients',
        ),
        'Memory'      => array(
            'used_memory',
        ),
        'Persistence' => array(
            'rdb_changes_since_last_save',
            'rdb_last_save_time',
        ),
        'Stats'       => array(
            'total_connections_received',
            'total_commands_processed',
            'expired_keys',
            'evicted_keys',
            'keyspace_hits',
            'keyspace_misses',
        ),
        'CPU'         => array(
            'used_cpu_sys',
            'used_cpu_user',
        ),
        'Keyspace'    => array(
            'db0' => array(
                'keys',
            ),
            'db1' => array(
                'keys',
            ),
        ),
    );

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
     * Kick off the daemon
     */
    public function start()
    {
        parent::start();

        $this->Reader = new RedisReader();

        while ($this->daemonCanRun())
        {
            $this->run();

            sleep( $this->getInterval() );
        }
    }

    /**
     * Retrieve snapshot and filter data
     */
    public function createSnapshot()
    {
        // retrieve the db statistics
        $serverData = $this->Reader->getDatabaseInformation( 'Castle' );

        $this->data = array();

        foreach ($this->usefulStatistics as $key => $value)
        {
            // find redis object container
            if (array_key_exists( $key, $serverData ))
            {
                // get vals of each child we wanted
                foreach ($value as $requested)
                {
                    if (!is_array( $requested ))
                    {
                        $this->data[\Str::camel( $requested )] = $serverData[$key][$requested];
                    }
                }
            }
        }

        foreach ($this->usefulStatistics['Keyspace'] as $this->database => $elements)
        {
            if (array_key_exists( $this->database, $serverData['Keyspace'] ))
            {
                foreach ($elements as $key)
                {
                    $this->data[$this->database][$key] = $serverData['Keyspace'][$this->database][$key];
                }
            }
        }
    }

    /**
     *
     */
    public function run()
    {
        $this->createSnapshot();

        if (empty( $this->data ))
        {
            $this->writeToErrorLog('Redis stats are unobservable');
            return false;
        }

        parent::run();

        // cache the current timestamp
        $currentTimestamp = time();

        // devices with udpConnections
        $liveStack = array();

        $this->Reader->Metrics->set( "redisStatistics:{$currentTimestamp}", json_encode($this->data, JSON_UNESCAPED_SLASHES) );

        $this->Reader->Metrics->lpush( "redisStatTimes", $currentTimestamp );

        $this->writeToLog('Stored redis stats at ' . date('M jS @ H:i:s', $currentTimestamp) );
    }
}
