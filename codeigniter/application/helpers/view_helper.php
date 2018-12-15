<?php
//use Jenssegers\Blade\Blade;

if( !function_exists('view') )
{
	function view( $view , $data=[] , array $cache = [] )
	{
		$blade = My\Load::file(
			Jenssegers\Blade\Blade::class , 
			APPPATH . 'views' , 
			APPPATH .'cache/blade'
		);
		try{
			//get_instance()->output->_display( $blade->make($view,$data) );
			if( isset($cache['id']) && isset($cache['time']) && isset(get_instance()->cache) )
			{				
				if ( ! $foo = get_instance()->cache->get( $cache['id'] ))
				{
						$foo = $blade->make($view,$data);
						// Save into the cache in seconds
						get_instance()->cache->save($cache['id'] , (string)$foo, $cache['time'] );
				}
				echo $foo;
			}else{
				echo $blade->make($view,$data);
			}
		}catch(Error $e){
			show_error( $e->getMessage() );
		}catch(Exception $e){
			show_error( $e->getMessage() );
		}
		
	}
}

if( !function_exists('view_cache') )
{
	function view_cache( string $key_cache ):bool
	{
		if(!isset(get_instance()->cache))
		{
			get_instance()->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		}
		
		if ( $foo = get_instance()->cache->get( $key_cache ))
		{
			echo $foo;
			return true;
		}
		
		return false;
	}
}

if( !function_exists('view_404') )
{
	function view_404():void
	{
		if( !isset(get_instance()->cache))
		{
			get_instance()->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		}
		get_instance()->output->set_status_header(404);
		view('web.404',['title'=>'Page not found '] ,['id'=>'404','time'=>600]); exit;
	}
}

if( !function_exists('asset') )
{
	function asset( String $path ):string
	{
		if(preg_match('/http|https|\/\//i',$path) ){
			return $path;
		}
		return get_instance()->config->base_url(  'assets/'. trim($path, '/') );
	}
}

if( !function_exists('route') )
{
	function route( string $routeName , array $replace=[] )
	{
		$urlString = Route::getRouteListByName($routeName)->url;
		
		if( preg_match_all('#\([^\)]([^/]*)\)#',$urlString, $matches) ){
			$matches = $matches[0];
			$cnt_replace = count($replace); $cnt_matches = count($matches);
			if( $cnt_replace < $cnt_matches ){
				$message = " Route {$routeName} require {$cnt_matches} variabel , provide {$cnt_replace} ";
				if( env('DEBUG') )
				{
					show_error( $message );
				}else throw new Exception($message);
			}
			$urlString = str_replace($matches,$replace,$urlString);
		}
		return '//'.$_SERVER['HTTP_HOST'] .'/'.$urlString ;
	}
}