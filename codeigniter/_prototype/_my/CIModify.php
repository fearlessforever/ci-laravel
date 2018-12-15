<?php
namespace My;
use Exception;
use My\Load;

class CIModify{
	
	public static function file( string $key , string $className ):void
	{
		get_instance()->$key = Load::file($className);
	}
}