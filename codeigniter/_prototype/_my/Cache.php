<?php
namespace My;
use Closure;
use Illuminate\Support\Carbon;

class Cache{
	public static function remember( string $key , $time , $default='' )
	{
		if( !isset(get_instance()->cache))
		{
			get_instance()->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		}
		$seconds = 0;
		
		if( $time instanceof Carbon)
		{
			$seconds = $time->diffInSeconds();
		}elseif(is_int($time))
		{
			$seconds = $time;
		}
		$cached = get_instance()->cache->get( $key.'.cache' );
		if(!empty($cached))
		{
			return $cached;
		}
		
		$cached = $default instanceof Closure ? $default() : $default ;
		
		if ( !empty($cached) )
		{
			get_instance()->cache->save( $key.'.cache' , $cached , $seconds );
		}
		return $cached;
	}
}