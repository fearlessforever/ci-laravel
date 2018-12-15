<?php
namespace Data;
trait TraitData{
	protected $data=[];
	
	public function __isset($key) {
		if($key == 'list'){
			return !empty($this->data)??false ;
		}
		return !empty($this->data[$key])??false ;
	}
  
	public function __set($key , $value ):void{
		
	}
	
	public function __get( $key ){
		if( $key == 'list' ){
			return $this->data;
		}
		return isset( $this->data[$key] ) ? $this->data[$key] : '';
	}
}