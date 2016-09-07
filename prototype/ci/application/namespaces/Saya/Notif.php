<?php

namespace Saya;
/*
|------------------------------------------------------------------------------
|	Simple Class untuk Log Notification
|	Ini membutuhkan Table z_notif , {Table}pengguna , {Table}pengguna_ext
|------------------------------------------------------------------------------
*/

Class Notif{
	private static $tipe = array(
		0 => 'Login' , 1 => 'Update' , 2 =>'Database Error'
	);
	
	public static function set($tipe ,$keterangan , $userid='')
	{
		DB::insert("INSERT INTO z_notif(waktu,tipe,userid,keterangan) VALUES(UNIX_TIMESTAMP() ,:tipe,:userid,:keterangan) ",
			array('tipe'=>$tipe,'userid'=>$userid,'keterangan'=>$keterangan )
		);
	}
	public static function check( $last_seen_notif = 0 )
	{
		if(!isset($_SESSION))return array('error'=>'No Session , Please Reload Or Relogin !!!');
		if(isset($_SESSION['notif_last_check'])){
			$_time = time() - $_SESSION['notif_last_check'] ;
			if( $_time < 61){
				session_write_close();
				return array('timestamp'=> $_SESSION['notif_last_check'] ,'next'=>( 61 - $_time) );
			}
		}
		$_SESSION['notif_last_check'] = time();
		
		$get = DB::select("SELECT count(1) as hasil FROM z_notif WHERE waktu > :waktu LIMIT 1" ,array('waktu'=>$last_seen_notif ) );
		if(isset($get[0]) && is_array($get) ){
			return array('berhasil'=>$get[0]['hasil'] );
		}
		return false;
	}
	public static function get( $limit = 5 , $userid=false)
	{
		$limit = ($limit > 0) ? $limit : 5 ;  
		$get = DB::select("
			SELECT FROM_UNIXTIME( a.waktu , '%d %M %Y ~ %H:%i') as n_waktu,a.tipe,a.keterangan as ket,b.nama,b.photo,b.userid
			FROM z_notif a
			LEFT JOIN ( 
				SELECT x.userid,x.nama,GROUP_CONCAT(isi SEPARATOR '') as photo 
				FROM ". KODE ."pengguna x 
				LEFT JOIN ". KODE ."pengguna_ext xx ON xx.userid=x.userid 
				WHERE xx.nama='folder' OR xx.nama='profile_pic' GROUP BY x.userid
			) b ON a.userid = b.userid
			ORDER BY a.waktu DESC
			LIMIT {$limit}
			" );
		if(isset($get[0]) && is_array($get) ){
			if($userid){
				DB::insert('INSERT INTO '. KODE .'pengguna_ext(userid,nama,isi) VALUES(:userid,:nama,UNIX_TIMESTAMP() ) ON DUPLICATE KEY UPDATE isi=VALUES(isi) '
					,array('userid'=> $userid,'nama'=>'last_seen_notif')
				);
			}
			return array('berhasil'=>$get ,'tipe'=> self::$tipe );
		}
		return false;
	}
}