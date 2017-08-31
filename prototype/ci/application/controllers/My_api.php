<?php
use App\Api\Accesstoken ;
use App\Api\Config ;
use App\Api\Respond as Resp;

Class My_api extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('load');
	}
	function route($id=null)
	{		
		try{
			$api = new Config;
			$url = $this->uri->segment( $api->getSegment() );
			$this->output->set_header('Access-Control-Allow-Origin : *');
			$resp=null;
			
			$api->validate('url',$url);
			$api->validate('accesstoken',$url) ? Accesstoken::init()->read() : false ;
			$model = 'api/'.strtolower( $api->getSegment(true) ).'/'. $api->model($url) ;
			if(!file_exists(APPPATH ."models/{$model}.php"))
				throw new Exception('Model File Not Found' );
			$this->load->model( $model ,'proses',false);
			$this->proses->run();
			
		}catch(Exception $e){
			$errorCode = $this->input->get('errorcode');
			($errorCode == 'false') ? false : $this->output->set_status_header(503) ;
			$resp = ['error'=> $e->getMessage() ]; 
		}
		Resp::json($api, $resp);
	}
}