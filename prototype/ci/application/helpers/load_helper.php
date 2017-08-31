<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*------------------------------------------------------------
Helper Ini Ini Untuk Melakukan Auto Include Class yang Menggunakan Konsep NameSpace
--------------------------------------------------------------*/
spl_autoload_register(function ($name) {
	$name = str_replace('\\', DIRECTORY_SEPARATOR , $name );
	if(strpos($name, DIRECTORY_SEPARATOR ) !== false ){
		$name = APPPATH .'namespaces'. DIRECTORY_SEPARATOR . $name.'.php'; 
		if(!file_exists($name))show_error(' File : <strong style="color:red;"> '.$name.' </strong> not found ');
		require_once ($name);
	}
});