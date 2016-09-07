<?php if(!defined('BASEPATH'))exit('No Direct script acces Allowed');

use Saya\Template as Temp;
class Dashboard extends CI_Model {
	static $_hasil= array('error'=>'Mode Not Found');
	function __construct() {
		parent::__construct();
		
	}
	
	public function run(){
		$check = $this->input->is_ajax_request();
		if($check){
			header('Content-Type:application/json');
			$mode = $this->input->post('mode');
			switch($mode){
				case 'view': Temp::view_json( array('{memory_usage}' ) , TRUE);
					//self::__view(); 
					break;
				default: break;
			}
			return true;
		}show_404();
	}
	
	private function __view(){
		
	}
}