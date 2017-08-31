<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Saya\Template as Temp;
use Model\User;

class Rumah_ny extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('load');
		Saya\Session::ci2();
	}
	public function index()
	{
		$ajax = $this->input->is_ajax_request();
		if( User::is_logged_in() ){
			if($ajax){
				Temp::view_json(
					array('berhasil'=>'You Have Logged In','location'=>$this->config->item('dashboard_page') )
				, TRUE );
				return;
			}else{
				redirect( base_url('internal-nya') );
			}
		}
		
		if($ajax){
			$hasil=array('error' => 'Not Found ');
			$data = array(
				'userid'=> $this->input->post('username')
				,'password'=> $this->input->post('password')
				,'remember'=> $this->input->post('remember')
			);
			if( !empty($data['userid']) && !empty($data['password']) ){
				$hasil= User::login($data) ;
			}
			Temp::view_json($hasil , TRUE );
		}else{
			Temp::$data['halaman_js'] =$this->load->view('login/login-js', Temp::getData( ) , TRUE);
			Temp::view(
				$this->load->view('login/login', Temp::getData( ) , TRUE)
			);
		}
		
	}
	public function logout()
	{
		$ajax = $this->input->is_ajax_request();
		if( User::is_logged_in() ){
			$this->session->sess_destroy();
			if($ajax){
				Temp::view_json(
					array('berhasil'=>'You Have Logout','location'=>base_url() )
				, TRUE );
				return;
			}else{
				redirect( base_url( ) );
			}
		}else{
			redirect( base_url( ) ,'refresh');
		}
	}
	
}
