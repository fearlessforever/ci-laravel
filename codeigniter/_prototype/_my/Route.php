<?php
namespace My;
use Exception;

class Route{
	public static $routeList=[
		
	];
	public static function add( $routeString , $handle = '' ):RouteInstance
	{
		if( $routeString instanceof RouteInstance )
		{
			$route = $routeString;
		}elseif(is_string( $routeString )){
			$route = new RouteInstance($routeString , $handle);
		}else{
			throw new Exception(' Cant add route ');
		}		
		self::$routeList[$route->getName()]=$route;
		return $route;
	}
	
	public static function all():array
	{
		$routes = [];
		foreach( self::$routeList as $val){
			$routes[$val->url]=$val->handle;
		}
		return $routes;
	}
	
	public static function getRouteListByName( string $routeName ):RouteInstance
	{
		return self::$routeList[$routeName];
	}
	
	public static function has( string $routeName ):bool
	{
		return isset(self::$routeList[$routeName]) ? true : false;
	}
	
	public static function unsetRouteByName( string $routeName ):void
	{
		unset(self::$routeList[$routeName]);
	}
}

class RouteInstance{
	public $name='';
	public $handle='';
	public $url='';
	
	function __construct($routeString , $handle )
	{
		$this->name = md5($routeString);
		$this->handle = $handle;
		$this->url = trim($routeString,'/');
	}
	public function getName():string
	{
		return $this->name;
	}
	
	public function name( string $routeName )
	{
		$route = Route::getRouteListByName($this->name);
		Route::unsetRouteByName($this->name);
		$route->name = $routeName ;
		Route::add($route);
	}
}