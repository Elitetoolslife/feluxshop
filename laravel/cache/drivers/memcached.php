<?php namespace Laravel\Cache\Drivers; use Memcache;

/**
 * The Memcached class provides a driver for Memcached based caching.
 *
 * @package  	Laravel
 * @author  	Taylor Otwell <taylorotwell@gmail.com>
 * @copyright  	2012 Taylor Otwell
 * @license 	MIT License <http://www.opensource.org/licenses/mit>
 * @see  		http://memcached.org/
 */
class Memcached extends Driver {

	/**
	 * The Memcache instance.
	 *
	 * @var Memcache
	 */
	protected $memcache;

	/**
	 * The cache key from the cache configuration file.
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * Create a new Memcached cache driver instance.
	 *
	 * @param  Memcache  $memcache
	 * @return void
	 */
	public function __construct(Memcache $memcache, $key)
	{
		$this->key = $key;
		$this->memcache = $memcache;
	}

	/**
	 * Determine if an item exists in the cache.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function has($key)
	{
		return ( ! is_null($this->get($key)));
	}

	/**
	 * Retrieve an item from the cache driver.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	protected function retrieve($key)
	{
		if (($cache = $this->memcache->get($this->key.$key)) !== false)
		{
			return $cache;
		}
	}

	/**
	 * Write an item to the cache for a given number of minutes.
	 *
	 * <code>
	 *		// Put an item in the cache for 15 minutes
	 *		Cache::put('name', 'Taylor', 15);
	 * </code>
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  int     $minutes
	 * @return void
	 */
	public function put($key, $value, $minutes)
	{
		$this->memcache->set($this->key.$key, $value, 0, $minutes * 60);
	}

	/**
	 * Delete an item from the cache.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function forget($key)
	{
		$this->memcache->delete($this->key.$key);
	}

}