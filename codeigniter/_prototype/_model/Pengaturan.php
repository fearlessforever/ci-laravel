<?php
namespace Model;
use My\Eloquent;

class Pengaturan extends Eloquent{
	protected $table= KODE .'pengaturan';
	protected $primaryKey='nama';
	protected $keyType='string';
}