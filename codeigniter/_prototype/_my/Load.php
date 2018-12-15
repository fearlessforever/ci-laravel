<?php
namespace My;

class Load{
	private static $loaded =[
	];
	
	// ...$variabel = splat operator in PHP
	
	public static function file( String $fileString , ...$variabel ):object
	{
		if( isset(self::$loaded[ $fileString ]) )
		{
			return self::$loaded[ $fileString ];
		}
		self::$loaded[$fileString]= new $fileString(...$variabel);
		return self::$loaded[$fileString];
	}
	public static function fileAlways( String $fileString , ...$variabel ):object
	{
		self::$loaded[$fileString]= new $fileString(...$variabel);
		return self::$loaded[$fileString];
	}
}