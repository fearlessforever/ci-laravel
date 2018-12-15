<?php
namespace My;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use My\Load;
class DBConnection{
	private static $is_initiate = false;
	
	public static function initiate( Array $config = null , String $name = 'default' ):void
	{
		if( self::$is_initiate && empty($config))
		{
			return ;
		}
		$capsule = Load::file(Capsule::class);
		if( isset( $capsule->getContainer()['config']['database.connections'][$name]) )
		{
			return;
		}
		
		$config = !empty($config) ? $config : [
			'driver'	=> env('DB_DRIVER'),
			'host'		=> env('DB_HOST'),
			'database'	=> env('DB_NAME'),
			'username'	=> env('DB_USER'),
			'password'	=> env('DB_PASSWORD'),
			'charset'	=> env('DB_CHARSET' , 'utf8') ,
			'collation'	=> env('DB_COLLATION' , 'utf8_unicode_ci') ,
			'prefix'	=> '',
		];
		$capsule->addConnection( $config  , $name ); 
		
		self::$is_initiate = true;
		
		// Make this Capsule instance available globally via static methods... (optional)
		if( env('DB_SET_GLOBAL',true) )
		{
			$capsule->setAsGlobal();
		}
		if( env('DB_SET_ORM' , false ) )
		{
			// Set the event dispatcher used by Eloquent models... (optional)
			$capsule->setEventDispatcher(new Dispatcher(new Container));
			$capsule->bootEloquent();
		}
			/*
			|-------------------------------------------------------------------------------
			|	Set Fetch Mode : Array atau Object , Default :Object
			|	Comment Line below If You want To Fetch from Mysql as an Object
			|-------------------------------------------------------------------------------
			*/
		if( env('DB_FETCH_ARRAY',false) )
		{
			//$capsule->getConnection()->setFetchMode(\PDO::FETCH_ASSOC);
			$capsule->setFetchMode(\PDO::FETCH_ASSOC);
		}
		
	}
}