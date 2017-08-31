<?php
namespace App\Api;

Class Respond {
	private static $resp=['error'=>'Respond Not Set !!! '];
	public static function set($data)
	{
		self::$resp = $data;
	}
	public static function get()
	{
		return self::$resp ;
	}
	public static function json( Config $cfg , $certain=null)
	{
		$hasil = empty($certain) ? self::$resp : $certain ;
		$hasil = is_string($hasil) ? $hasil : json_encode($hasil);
		
		if($cfg->limit() > 0){
			if(isset($hasil [ $cfg->limit() ])){
				$errorCode = get_instance()->input->get('errorcode');
				($errorCode == 'false') ? false : get_instance()->output->set_status_header(503) ;
				$hasil = '{"error":"Please decrease data limit"}';
			}
		}
		if( $cfg->noHtml() ){
			$hasil = str_replace(array('<','>',"'"),array('&lt;','&gt;','&#039;') , $hasil );
		}
		
		get_instance()->output->set_content_type('application/json');
		get_instance()->load->view('json' , array('hasil' => $hasil) );
	}
}