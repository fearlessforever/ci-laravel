<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('view');
	}
	
	public function index():void
	{
		$proses = loader(Proses\Login::class);
		$data = $proses->getVariabel();
		view('web.login.index',$data);
	}
	
	public function getLogin():void
	{
		$this->output
			->set_status_header(200)
			->set_content_type('application/json');
			
		try{
			$proses = loader(Proses\Login::class);
			$data = $proses->getVariabel();
			$data=[
				'status'=>'success',
				'message'=>'get user information',
			];
		}catch(Exception $e){
			$this->output->set_status_header(503);
			$data=[
				'status'=>'error',
				'message'=>$e->getMessage(),
			];
		}
		$this->output->set_output(json_encode($data));;
	}
}
