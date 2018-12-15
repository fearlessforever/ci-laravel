<?php
namespace My;
use Illuminate\Database\Eloquent\Model;
use My\DBConnection;

class Eloquent extends Model{
	final function __construct()
	{
		if( !env('DB_SET_ORM') ){
			show_error('You have not set DB_SET_ORM in your config file');
		}
		DBConnection::initiate();
	}
}