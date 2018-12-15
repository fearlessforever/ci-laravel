<?php
namespace My;
use My\DBConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

class DB{
	
	public static function __callStatic($method,$params)
	{
		DBConnection::initiate();
		if(!method_exists( Capsule::class ,$method) && !method_exists(Capsule::connection() , $method)){
			$message = "Call to undefined method DB::{$method}()";
			if( env('DEBUG') )
				show_error( $message );
			else 
				throw new \Exception( $message );							
		}
		return call_user_func_array(array( Capsule::class ,$method), $params);
	}
}