<?php
namespace Model;
defined('BASEPATH') OR exit('No direct script access allowed');

use Saya\DB ;

Class User{
	
	static $data=null;
	
	function __construct()
	{
	
	}
	
	public static function is_logged_in( $read =false)
	{
		if(!empty(self::$data) && !$read ){
			return true;
		}
		$CI = &get_instance();
		if(!isset($CI->session))show_error('<strong>Session Not Found </strong>',503);
		$a = $CI->session->all_userdata();
		
		if(isset($a['userid']) && isset($a['nama']) ){
			self::$data=array(
				'userid'=>$a['userid'] ,'nama'=>$a['nama'],'level'=>date('Y-m-d H:i:s'),'nama_d'=>'','blokir'=>'N','extra'=>array(),'modul'=>array() ,'md5'=>''
			);
			if($read){
				DB::koneksi();
				$user= DB::select("SELECT level,nama,blokir,passnya as md5 FROM ". KODE ."pengguna WHERE userid=:userid LIMIT 1" ,array('userid'=> $a['userid'] ) ) ;
				if(isset($user[0])){
					self::$data =array_merge( self::$data ,$user[0] );
					$b = explode(' ',self::$data['nama']);
					self::$data['nama_d'] = $b[0];
				}else{
					$CI->session->sess_destroy();
					$ajax = $CI->input->is_ajax_request();
					if(!$ajax){
						show_error(' <h1 style="font-weight:bold; color:red;" >[ DATA ANDA TIDAK DITEMUKAN SYSTEM ] <a href="'. base_url() .'"> HOME </a> </h1> ',404);
					}
					exit;
				}
				$user= DB::select("SELECT nama,isi FROM ". KODE ."pengguna_ext WHERE userid=:userid LIMIT 17" ,array('userid'=> $a['userid'] ) ) ;
				self::$data['extra'] = ganti($user , 'nama' , 'isi');
				if(self::$data['level'] != 'admin'){
					$user= DB::table(KODE .'pengguna_izin')->select('nama_app as nama','nama_app as isi')->where('level',self::$data['level'] )->limit(27)->get();
					self::$data['modul'] = ganti($user , 'nama' , 'isi');
				}
				
			}
			return true;
		}else{
			return false;
		}
	}
	
	public static function login( $data )
	{
		if( self::is_logged_in( TRUE ) ){
			return array('berhasil'=>'Logged In !!!' ,'location'=>'internal-nya');
		}
		$a=array('error' => 'Username & Password Not Match' );
		if( !isset($data) ){
			return $a;
		}
		
		DB::koneksi();
		$user= DB::table(KODE .'pengguna')->select('userid','nama','passnya','blokir')->where('email',$data['userid'])->orWhere('username',$data['userid'])->limit(1)->first() ;
		
		if(isset($user['userid']) && is_array($user ) ){
			if( $user['blokir'] != 'N' ){
				return array('error'=>'Can\'t Log into System, You have been Blocked !!!' );
			}
			if (password_verify($data['password'], $user['passnya'] )) {
				//$_SESSION['userid']= $user['userid']; $_SESSION['nama']= $user['nama'];
				$a = array(
					'berhasil'=>'You have Logged in' ,'location'=>'internal-nya'
				);
				if( !empty($data['remember']) ){
					$cookieName = get_instance()->config->item('sess_cookie_name'); // we get the cookie
					$cookie = get_instance()->input->cookie( $cookieName ); // we get the cookie
					
					if(!empty($cookie))
					{
						get_instance()->input->set_cookie( $cookieName , $cookie, '35580000');
					}
					
				}
				get_instance()->session->set_userdata([
					'userid'=>$user['userid'],'nama'=> $user['nama']
				]);
				$a = array(
					'berhasil'=>'You have Logged in' ,'location'=>get_instance()->config->item('dashboard_page')
				);
				\Saya\Notif::set( 0 , '' , $user['userid'] );
			}
			
		}
		return $a ;
	}
	
	
}

function ganti ($data,$key , $val =null ){
	$baru=array();
	foreach($data as $v ){
		$baru[ $v[ $key ] ] = ($val == null) ? $v : $v[ $val ];
	}
	return $baru;
}