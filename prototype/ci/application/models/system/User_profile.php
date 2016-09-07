<?php if(!defined('BASEPATH'))exit('No Direct script acces Allowed'); 

use Saya\Validasi ;
use Saya\Upload;

class User_profile extends CI_Model {
	static $_hasil= array('error'=>'Mode Not Found');
	
	function __construct() {
		parent::__construct();
	}
	
	public function run(){
		$check = $this->input->is_ajax_request();
		/* if($check){
			header('Content-Type:application/json');
			$mode = $this->input->post('mode');
			switch($mode){
				case 'ganti-password': self::__change_pass(); break;
				case 'ganti-nama': self::__change_name(); break;
				case 'view': self::__view(); break;
				default: break;
			}
			Saya\Template::view_json( self::$_hasil , TRUE);
			return true;
		} */
			$mode = $this->input->post('mode');
			switch($mode){
				case 'ganti-password': 
					if($check){
						self::__change_pass();
						Saya\Template::view_json( self::$_hasil ,TRUE);
						return true;
					}
					break;
				case 'ganti-nama':
					if($check){
						self::__change_name();
						Saya\Template::view_json( self::$_hasil ,TRUE);
						return true;
					}
					break;
				case 'view':
					if($check){
						self::__view();
						Saya\Template::view_json( self::$_hasil ,TRUE);
						return true;
					}
					break;
				case 'profile-pic':
					self::__set_photo_profile();
					$_referer = $this->input->get_request_header('Referer') ;
					$_referer .= '#'. $this->uri->segment(3) .'.html';
					echo self::$_hasil ; @header( 'Refresh:2,' .$_referer ,'refresh');
					return true ;
					break;
				
				default: break;
			}
		show_404();
	}
	
	private function __set_photo_profile(){
		self::$_hasil ='<h1 style="text-align:center; font-weight:bold; color:red;">Gagal Simpan Photo Profile !!!</h1>';
		
		if(!isset( $_FILES['upload_image']['tmp_name'] ))return;
		
		$_nama = md5( Model\User::$data['userid'] ).'.jpg';
		Upload::$_folder = 'upload/profile/'; Upload::$_max_width=300;
		$_check_img = Upload::generate_image_thumbnail($_FILES['upload_image']['tmp_name'] , $_nama );
		if(!$_check_img)return;
		$data =array(
			array('userid'=> Model\User::$data['userid'] ,'nama'=>'folder','isi'=> Upload::$_folder)
			,array('userid'=> Model\User::$data['userid'] ,'nama'=>'profile_pic','isi'=> $_nama )
		);
		
		$save=null; $query =null;
		$set = Saya\Template::getData();
		try{
			$query = Saya\DB::connection()->getPdo()->prepare("INSERT INTO ".KODE."pengguna_ext(userid,nama,isi) VALUES(:userid,:nama,:isi) ON DUPLICATE KEY UPDATE isi=VALUES(isi) ");
		}catch(PDOException $e){
			self::$_hasil = empty($set['sys_debug_db']) ? '[DB] Ada Kesalahan di simpan data' : $e->getMessage();
		}
		if($query){
			foreach($data as $val){
				try{
					$save = $query->execute($val);
				}catch(PDOException $e){
					self::$_hasil = empty($set['sys_debug_db']) ? '[DB] Ada Kesalahan di simpan data' : $e->getMessage();
					return ;
				}
			}
		}
			
		if($save){
			self::$_hasil='<h1 style="text-align:center; font-weight:bold; margin:30px auto;"> Background Telah Disimpan</h1>';
		}
	}
	
	private function __change_name(){
		self::$_hasil =array('error'=>'Gagal Simpan');
		$data =array(
			'nama'=> $this->input->post('nama',TRUE)
		);
		if( !Validasi::_array($data,'nama') ){
			self::$_hasil =array('error'=>'Nama Tidak Boleh Kosong !!!'); return;
		}
		
		$save=null; 
		$set = Saya\Template::getData();
		
		try{
			$save = Saya\DB::update("UPDATE ".KODE."pengguna SET nama=:nama WHERE userid=:userid LIMIT 1",array('nama'=> $data['nama'],'userid'=> Model\User::$data['userid'] ) );
		}catch(PDOException $e){
			self::$_hasil= array('error' => empty($set['sys_debug_db']) ? '[DB] Ada Kesalahan di simpan data' : $e->getMessage() ); return;
		}
		if($save){
			self::__view();
			self::$_hasil=array(
				'berhasil'=>'Data Berhasil Disimpan '
				,'baru'=>self::$_hasil['berhasil']
			); 
		}else self::$_hasil=array('error'=>'Tidak Ada Data yg Diubah');
	}
	private function __change_pass(){
		self::$_hasil =array('error'=>'Gagal Simpan');
		$data =array(
			'pass_lama'=> $this->input->post('pass_lama')
			,'pass_baru'=> $this->input->post('pass_baru')
			,'pass_baru_con'=> $this->input->post('pass_baru_con')
		);
		if( !Validasi::_array($data,'pass_lama|pass_baru|pass_baru_con') ){
			self::$_hasil =array('error'=>'Pass Lama , Baru dan Konfirmasi Tidak Boleh Kosong !!!'); return;
		}
		if( $data['pass_lama'] == $data['pass_baru'] ){
			self::$_hasil =array('error'=>'Pass Baru Tidak Boleh Sama Dengan Pass Lama !!! '); return;
		}
		if( $data['pass_baru'] != $data['pass_baru_con'] ){
			self::$_hasil =array('error'=>'Pass Baru Tidak sama Dengan Password Konfirmasi !!! '); return;
		}
		
		if(!isset( Model\User::$data['md5'] )){
			self::$_hasil =array('error'=>'User Id Tidak Ditemukan !!!'); return;
		}
		
		if (! password_verify( $data['pass_lama'] , Model\User::$data['md5'] )){
			self::$_hasil =array('error'=>'Pass Lama Tidak Sama !!!'); return;
		}
		$password = password_hash($data['pass_baru'] , PASSWORD_DEFAULT );
		$save=null; 
		$set = Saya\Template::getData();
		
		try{
			$save = Saya\DB::update("UPDATE ".KODE."pengguna SET passnya=:pass WHERE userid=:userid LIMIT 1" , array('userid'=> Model\User::$data['userid'],'pass'=>$password ) );
		}catch(PDOException $e){
			self::$_hasil= array('error' => empty($set['sys_debug_db']) ? '[DB] Ada Kesalahan di simpan data' : $e->getMessage() ); return;
		}
		
		if($save){
			self::$_hasil=array('berhasil'=>'Data Berhasil Disimpan '); 
		}else self::$_hasil=array('error'=>'Tidak Ada Data yg Diubah');
	}
	
	private function __view(){
		self::$_hasil =array('error'=>'Data Tidak Ditemukan');
		$userid = false;
		$userid = empty($userid) ? Model\User::$data['userid'] : $userid ;
		if( !Validasi::_angka($userid ,'',true) ){
			self::$_hasil['error']='Userid Tidak Boleh Kosong'; return;
		}
		
		$core = Saya\DB::select("
			SELECT a.userid,DATE_FORMAT(a.buat,'%d %M %Y ~ %H:%i') as buat,a.level,a.nama ,b.ket as level_ket,b.bintang
			FROM ".KODE."pengguna a
			LEFT JOIN ".KODE."pengguna_lvl b ON a.level=b.level
			WHERE a.userid=:userid LIMIT 1 
			",array('userid'=> $userid ) );
		$core = isset($core[0]) ? $core[0] : $core ;
		if(!isset($core['userid'])){
			self::$_hasil =array('error'=>'User Tidak ditemukan'); return;
		}
		
		$userdata = array(); $userdata = $core ;
		//$core = Saya\DB::table(KODE .'pengguna_ext')->select('nama','isi')->where('userid',$userid)->limit(27)->get();
		//foreach($core as $val)$userdata['extra'][ $val['nama'] ]=$val['isi'];
		
		if(isset( Model\User::$data['extra'] ) && is_array( Model\User::$data['extra'] ) ){
			$userdata['extra'] = Model\User::$data['extra'];
		}
		self::$_hasil = array('berhasil'=>$userdata );
	}
}