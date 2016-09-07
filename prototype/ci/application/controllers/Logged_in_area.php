<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Saya\Template as Temp;
use Model\User;
use Model\Logged_area as AAA;

class Logged_in_area extends CI_Controller {
	
	public $ajax=false;
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('load');
	}
	
	public function route($a=null)
	{
		$this->ajax = $this->input->is_ajax_request();
		if( !User::is_logged_in() ){
			if($this->ajax){
				Temp::view_json(
					array('error'=>'You Have Logout !!! ','location'=>base_url() )
				, TRUE );
				return;
			}else{
				redirect( base_url() );
			}
		}
		
		switch($a){
			case NuLL : self::___utama(); break;
			case 'pages' : self::___pages('view'); break;
			case 'ajax' : self::___pages('model'); break;
			default: show_404(); break;
		}
	}
	
	private function ___utama()
	{
		if($this->ajax){
			$hasil=array('error' => TRUE); 
			Temp::view_json($hasil , TRUE );
		}else{
			User::is_logged_in(true);
			Temp::$data['logged_in']=true;
			Temp::view( );
		}
		
	}
	private function ___pages( $mode )
	{
		$id = $this->uri->segment(3);
		switch($mode){
			case 'view': 
				if($this->ajax && !empty($id) ){
					User::is_logged_in(true);
					$a = AAA::get( $id , $mode );
					if(!empty($a)){
						Temp::view_json($a );
						return;
					}
				}
				break;
			case 'model':
				if( !empty($id) ){
					User::is_logged_in(true);
					$a = AAA::get( $id , $mode );
					if(!empty($a)){
						if(is_array($a))Temp::view_json($a );
						return;
					}
				}
				break;
			default:break;
		}
		show_404();		
	}
	
}
