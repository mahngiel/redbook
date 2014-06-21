<?php namespace Reeck\Redbook\Support;

use Illuminate\Redis\Database;
use Illuminate\Support\Facades\Config;

/**
 * @method exists() Predis\Command\KeyExists
 * @method del() Predis\Command\KeyDelete
 * @method type() Predis\Command\KeyType
 * @method keys() Predis\Command\KeyKeys
 * @method randomkey() Predis\Command\KeyRandom
 * @method rename() Predis\Command\KeyRename
 * @method renamenx() Predis\Command\KeyRenamePreserve
 * @method expire() Predis\Command\KeyExpire
 * @method expireat() Predis\Command\KeyExpireAt
 * @method ttl() Predis\Command\KeyTimeToLive
 * @method move() Predis\Command\KeyMove
 * @method sort() Predis\Command\KeySort
 * @method dump() Predis\Command\KeyDump
 * @method restore() Predis\Command\KeyRestore
 * @method set() Predis\Command\StringSet
 * @method setnx() Predis\Command\StringSetPreserve
 * @method mset() Predis\Command\StringSetMultiple
 * @method msetnx() Predis\Command\StringSetMultiplePreserve
 * @method get() Predis\Command\StringGet
 * @method mget() Predis\Command\StringGetMultiple
 * @method getset() Predis\Command\StringGetSet
 * @method incr() Predis\Command\StringIncrement
 * @method incrby() Predis\Command\StringIncrementBy
 * @method decr() Predis\Command\StringDecrement
 * @method decrby() Predis\Command\StringDecrementBy
 * @method rpush() Predis\Command\ListPushTail
 * @method lpush() Predis\Command\ListPushHead
 * @method llen() Predis\Command\ListLength
 * @method lrange() Predis\Command\ListRange
 * @method ltrim() Predis\Command\ListTrim
 * @method lindex() Predis\Command\ListIndex
 * @method lset() Predis\Command\ListSet
 * @method lrem() Predis\Command\ListRemove
 * @method lpop() Predis\Command\ListPopFirst
 * @method rpop() Predis\Command\ListPopLast
 * @method rpoplpush() Predis\Command\ListPopLastPushHead
 * @method sadd() Predis\Command\SetAdd
 * @method srem() Predis\Command\SetRemove
 * @method spop() Predis\Command\SetPop
 * @method smove() Predis\Command\SetMove
 * @method scard() Predis\Command\SetCardinality
 * @method sismember() Predis\Command\SetIsMember
 * @method sinter() Predis\Command\SetIntersection
 * @method sinterstore() Predis\Command\SetIntersectionStore
 * @method sunion() Predis\Command\SetUnion
 * @method sunionstore() Predis\Command\SetUnionStore
 * @method sdiff() Predis\Command\SetDifference
 * @method sdiffstore() Predis\Command\SetDifferenceStore
 * @method array smembers() smembers( $index ) Predis\Command\SetMembers
 * @method srandmember() Predis\Command\SetRandomMember
 * @method zadd() Predis\Command\ZSetAdd
 * @method zincrby() Predis\Command\ZSetIncrementBy
 * @method zrem() Predis\Command\ZSetRemove
 * @method zrange() Predis\Command\ZSetRange
 * @method zrevrange() Predis\Command\ZSetReverseRange
 * @method zrangebyscore() Predis\Command\ZSetRangeByScore
 * @method zcard() Predis\Command\ZSetCardinality
 * @method zscore() Predis\Command\ZSetScore
 * @method zremrangebyscore() Predis\Command\ZSetRemoveRangeByScore
 * @method ping() Predis\Command\ConnectionPing
 * @method auth() Predis\Command\ConnectionAuth
 * @method select() Predis\Command\ConnectionSelect
 * @method echo () Predis\Command\ConnectionEcho
 * @method quit() Predis\Command\ConnectionQuit
 * @method info() Predis\Command\ServerInfoV26x
 * @method slaveof() Predis\Command\ServerSlaveOf
 * @method monitor() Predis\Command\ServerMonitor
 * @method dbsize() Predis\Command\ServerDatabaseSize
 * @method flushdb() Predis\Command\ServerFlushDatabase
 * @method flushall() Predis\Command\ServerFlushAll
 * @method save() Predis\Command\ServerSave
 * @method bgsave() Predis\Command\ServerBackgroundSave
 * @method lastsave() Predis\Command\ServerLastSave
 * @method shutdown() Predis\Command\ServerShutdown
 * @method bgrewriteaof() Predis\Command\ServerBackgroundRewriteAOF
 * @method setex() Predis\Command\StringSetExpire
 * @method append() Predis\Command\StringAppend
 * @method substr() Predis\Command\StringSubstr
 * @method blpop() Predis\Command\ListPopFirstBlocking
 * @method brpop() Predis\Command\ListPopLastBlocking
 * @method zunionstore() Predis\Command\ZSetUnionStore
 * @method zinterstore() Predis\Command\ZSetIntersectionStore
 * @method zcount() Predis\Command\ZSetCount
 * @method zrank() Predis\Command\ZSetRank
 * @method zrevrank() Predis\Command\ZSetReverseRank
 * @method zremrangebyrank() Predis\Command\ZSetRemoveRangeByRank
 * @method hset() Predis\Command\HashSet
 * @method hsetnx() Predis\Command\HashSetPreserve
 * @method hmset() Predis\Command\HashSetMultiple
 * @method hincrby() Predis\Command\HashIncrementBy
 * @method hget() Predis\Command\HashGet
 * @method hmget() Predis\Command\HashGetMultiple
 * @method hdel() Predis\Command\HashDelete
 * @method hexists() Predis\Command\HashExists
 * @method hlen() Predis\Command\HashLength
 * @method hkeys() Predis\Command\HashKeys
 * @method hvals() Predis\Command\HashValues
 * @method hgetall() Predis\Command\HashGetAll
 * @method multi() Predis\Command\TransactionMulti
 * @method exec() Predis\Command\TransactionExec
 * @method discard() Predis\Command\TransactionDiscard
 * @method subscribe() Predis\Command\PubSubSubscribe
 * @method unsubscribe() Predis\Command\PubSubUnsubscribe
 * @method psubscribe() Predis\Command\PubSubSubscribeByPattern
 * @method punsubscribe() Predis\Command\PubSubUnsubscribeByPattern
 * @method publish() Predis\Command\PubSubPublish
 * @method config() Predis\Command\ServerConfig
 * @method persist() Predis\Command\KeyPersist
 * @method strlen() Predis\Command\StringStrlen
 * @method setrange() Predis\Command\StringSetRange
 * @method getrange() Predis\Command\StringGetRange
 * @method setbit() Predis\Command\StringSetBit
 * @method getbit() Predis\Command\StringGetBit
 * @method rpushx() Predis\Command\ListPushTailX
 * @method lpushx() Predis\Command\ListPushHeadX
 * @method linsert() Predis\Command\ListInsert
 * @method brpoplpush() Predis\Command\ListPopLastPushHeadBlocking
 * @method zrevrangebyscore() Predis\Command\ZSetReverseRangeByScore
 * @method watch() Predis\Command\TransactionWatch
 * @method unwatch() Predis\Command\TransactionUnwatch
 * @method object() Predis\Command\ServerObject
 * @method slowlog() Predis\Command\ServerSlowlog
 * @method client() Predis\Command\ServerClient
 * @method pttl() Predis\Command\KeyPreciseTimeToLive
 * @method pexpire() Predis\Command\KeyPreciseExpire
 * @method pexpireat() Predis\Command\KeyPreciseExpireAt
 * @method psetex() Predis\Command\StringPreciseSetExpire
 * @method incrbyfloat() Predis\Command\StringIncrementByFloat
 * @method bitop() Predis\Command\StringBitOp
 * @method bitcount() Predis\Command\StringBitCount
 * @method hincrbyfloat() Predis\Command\HashIncrementByFloat
 * @method eval() Predis\Command\ServerEval
 * @method evalsha() Predis\Command\ServerEvalSHA
 * @method script() Predis\Command\ServerScript
 * @method time() Predis\Command\ServerTime
 */
abstract class Redis extends \Illuminate\Redis\Database {

    /**
     * @var string
     */
    protected $database = 'default';

    /**
     * @var array
     */
    protected $schema = array();

    /**
     * @var array
     */
    protected $typeRequests = array(
        'set'  => 'smembers',
        'hash' => 'hgetall',
        'none' => null,
    );

    /**
     * @var \Predis\Connection\SingleConnectionInterface
     */
    protected $conn;

    /**
     * Retrieve a schema
     *
     * @param $schema
     * @param $key
     *
     * @return string
     * @throws \RedisSchemaException
     */
    public function getSchema( $schema, $key = null )
    {
        if (!isset( $this->schema[$schema] ))
        {
            throw new \RedisSchemaException( "The requested Schema \"$schema\" does not exist." );
        }

        // Operate on single keyed schemas
        if (!is_array( $key ) || $key === null)
        {
            return sprintf( $this->schema[$schema], $key );
        }

        // Handle multiple keyed schema
        return vsprintf( $this->schema[$schema], $key );
    }

    /**
     * Retrieve all data under a schema
     *
     * @param $schema
     * @param $key
     *
     * @return array
     */
    public function findAllBySchema( $schema, $key )
    {
        $type = $this->typeRequests[$this->type( $this->getSchema( $schema, $key ) )];

        if (!(string)$type)
        {
            return array();
        }

        return $this->{$type}( $this->getSchema( $schema, $key ) );
    }

    /**
     * @param $schema
     * @param $key
     */
    public function removeObject( $schema, $key )
    {
        return $this->del( $this->getSchema( $schema, $key ) );
    }

    /**
     * Check if a record exists for the schema / key
     *
     * @param $schema
     * @param $key
     *
     * @return mixed
     */
    public function objectExists( $schema, $key )
    {
        return $this->exists( $this->getSchema( $schema, $key ) );
    }

    /**
     * @param $schema
     * @param $key
     * @param $time
     *
     * @return mixed
     */
    public function setExpiration( $schema, $key, $time )
    {
        return $this->expire( $this->getSchema( $schema, $key ), $time );
    }

    /**
     * @param $schema
     * @param $key
     *
     * @return mixed
     */
    public function getExpiration( $schema, $key )
    {
        return $this->ttl( $this->getSchema( $schema, $key ) );
    }

    /*
    |--------------------------------------------------------------------------
    | Lists
    |--------------------------------------------------------------------------
    */

    /**
     * Retrieve the length of the list
     *
     * @param $schema
     * @param $key
     *
     * @return mixed
     */
    public function getListCount( $schema, $key )
    {
        return $this->llen( $this->getSchema( $schema, $key ) );
    }

    /**
     * Retrieve a range within the list
     *
     * @param $schema
     * @param $key
     * @param $start
     * @param $end
     *
     * @return mixed
     */
    public function getListRange( $schema, $key, $start, $end )
    {
        if ($start == 0 && $end == 0)
        {
            $count = $this->getListCount( $schema, $key );

            $end = $count - 1;
        }

        return $this->lrange( $this->getSchema( $schema, $key ), $start, $end );
    }

    /**
     * Retrieve a list item by its index
     *
     * @param $schema
     * @param $key
     * @param $index
     *
     * @return mixed
     */
    public function getListIndex( $schema, $key, $index )
    {
        return $this->lindex( $this->getSchema( $schema, $key ), $index );
    }

    /**
     * Add item to beginning of a list
     *
     * @param $schema
     * @param $key
     * @param $data
     *
     * @return mixed
     */
    public function addToListHead( $schema, $key, $data )
    {
        return $this->lpush( $this->getSchema( $schema, $key ), $data );
    }

    /**
     * Add item to end of a list
     *
     * @param $schema
     * @param $key
     * @param $data
     *
     * @return mixed
     */
    public function addToListFoot( $schema, $key, $data )
    {
        return $this->rpush( $this->getSchema( $schema, $key ), $data );
    }

    /*
    |--------------------------------------------------------------------------
    | Sets
    |--------------------------------------------------------------------------
    */

    /**
     * @param $schema
     * @param $key
     *
     * @return array
     */
    public function getStackMembers( $schema, $key )
    {
        return $this->smembers( $this->getSchema( $schema, $key ) );
    }

    /**
     * Transfer an object between sets
     *
     * @param $schema
     * @param $fromKey
     * @param $toKey
     * @param $member
     */
    public function moveBetweenStacks( $schema, $fromKey, $toKey, $member )
    {
        return $this->smove( $this->getSchema( $schema, $fromKey ), $this->getSchema( $schema, $toKey ), $member );
    }

    /**
     * Add a member to the set
     *
     * @param $stack
     * @param $key
     * @param $member
     */
    public function addToStack( $stack, $key, $member )
    {
        return $this->sadd( $this->getSchema( $stack, $key ), $member );
    }

    /**
     * Remove an item from a set
     *
     * @param $stack
     * @param $key
     * @param $member
     */
    public function removeFromStack( $stack, $key, $member )
    {
        return $this->srem( $this->getSchema( $stack, $key ), $member );
    }

    /**
     * @param $schema
     * @param $key
     * @param $member
     *
     * @return bool
     */
    public function isMemberInStack( $schema, $key, $member )
    {
        return $this->sismember( $this->getSchema( $schema, $key ), $member );
    }

    /*
    |--------------------------------------------------------------------------
    | Keys
    |--------------------------------------------------------------------------
    */

    /**
     * @param $schema
     * @param $key
     * @param $member
     *
     * @return mixed
     */
    public function setKey( $schema, $key, $member )
    {
        return $this->set( $this->getSchema( $schema, $key ), $member );
    }

    /**
     * @param $schema
     * @param $key
     *
     * @return mixed
     */
    public function getKey( $schema, $key )
    {
        return $this->get( $this->getSchema( $schema, $key ) );
    }

    /*
    |--------------------------------------------------------------------------
    | Hashes
    |--------------------------------------------------------------------------
    */

    /**
     * @param $schema
     * @param $key
     *
     * @return mixed
     */
    public function getHashMembers( $schema, $key )
    {
        return $this->hgetall( $this->getSchema( $schema, $key ) );
    }

    /**
     * @param $schema
     * @param $key
     * @param $member
     *
     * @return mixed
     */
    public function getHashMember( $schema, $key, $member )
    {
        return $this->hget( $this->getSchema( $schema, $key ), $member );
    }

    /**
     * Add a key and value to the hash schema
     *
     * @param       $schema
     * @param       $key
     * @param       $field
     * @param       $value
     */
    public function addHashMember( $schema, $key, $field, $value )
    {
        return $this->hset( $this->getSchema( $schema, $key ), $field, $value );
    }

    /**
     * @param       $schema
     * @param       $key
     * @param array $dataSet
     *
     * @return mixed
     */
    public function addHashMembers( $schema, $key, array $dataSet )
    {
        if (empty( $dataSet ))
        {
            return false;
        }

        return $this->hmset( $this->getSchema( $schema, $key ), $dataSet );
    }

    /**
     * @param       $schema
     * @param       $key
     * @param array $hashes
     *
     * @return mixed
     */
    public function removeHashMember( $schema, $key, array $hashes )
    {
        return $this->hdel( $this->getSchema( $schema, $key ), $hashes );
    }

    /*
    |--------------------------------------------------------------------------
    | Mapping
    |--------------------------------------------------------------------------
    */

    public function queryResults()
    {
    }

    /*
    |--------------------------------------------------------------------------
    | General Commands
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new Redis connection instance.
     */
    public function __construct( $database = null )
    {
        parent::__construct( \Config::get( 'redbook::database.redis' ) );

        $this->conn = $this->connection( $database ? : $this->database );
    }

    /**
     * Dynamically make a Redis command.
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @throws \RedisException
     *
     * @return mixed
     */
    public function __call( $method, $parameters )
    {
        return call_user_func_array( array( $this->clients[$this->database], $method ), $parameters );
    }
} 
