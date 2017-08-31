<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Saya\DB;
use Saya\Validasi;
use App\Api\Respond as Resp;
use App\Api\Accesstoken as AT;

class User extends CI_Model {
	
	function __construct() {
		parent::__construct();  
	}
	
	public function run()
	{
		try{
			$this->cfg = new App\Api\Config;
			$method = $this->uri->segment( $this->cfg->url() );
			switch(true){
				case ($method == 'insert'): $this->___insert(); break; 
				default :  $this->___me(); break;
			}
		}catch(PDOException $e){
			throw new Exception( $e->getMessage() );
		}
	}
	private function ___me(){
		DB::koneksi();
		$data = DB::table(KODE .'pengguna');
		//Baca UserID yang sedang akses
		$current_userid = AT::init()->userdata('userid');
		//Check apakah ada Input ID user Tertentu
		$idTertentu = $this->uri->segment( $this->cfg->url() ,0 );
		if(empty($idTertentu) || $current_userid == $idTertentu ){
			$data->where('userid', $current_userid )
				  ->select(DB::raw('userid,email,username,level,nama,buat,blokir'));
		}else{
			$data->where('userid',$idTertentu )
			        ->select(DB::raw('userid,email,username,level,nama'));
		}
		$data = $data->first();
		Resp::set([
			'data'=>$data
		]);
	}
	private function ___insert(){
		$_data_input = [
			'username'=> $this->input->post('username')
			,'email'=> $this->input->post('email')
			,'passnya'=> $this->input->post('password')
			,'level'=> $this->input->post('level')
			,'nama'=> $this->input->post('name')
		];
		if(!Validasi::_array($_data_input,'username|email|passnya|nama')){
			throw new Exception('Butuh username,email,password dan name untuk menambahkan User !!!');
		}
		$_data_input['passnya']=password_hash( $_data_input['passnya'] , PASSWORD_DEFAULT );
		//Baca UserID yang sedang akses
		$current_userid = AT::init()->userdata('userid');
		$_data_input['level']= ($current_userid == 1 && !empty($_data_input['level']) ) ? $_data_input['level'] : 'member' ;
		
		
		DB::koneksi();
		$data = DB::table(KODE .'pengguna')->insert($_data_input);
		Resp::set([
			'success'=>'Berhasil Menambahkan User'
		]);
	}
}