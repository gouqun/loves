<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Redis\Connections\Connection connection(string $name = null)
 *
 * @see \Illuminate\Redis\RedisManager
 * @see \Illuminate\Contracts\Redis\Factory
 */
class Goods extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Goods';
    }
}
