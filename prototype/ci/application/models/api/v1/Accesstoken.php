<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Saya\DB;
use Saya\Validasi;
use App\Api\Respond as Resp;
use App\Api\Accesstoken as AT;

class Accesstoken extends CI_Model {
	
	function __construct() {
		parent::__construct();  
	}
	
	public function run()
	{
		try{
			$api = new App\Api\Config;
			$method = $this->uri->segment( $api->url() );
			$isAccessTokenExist =  $this->input->get('accesstoken');
			switch(true){
				case !empty($isAccessTokenExist): $this->___read(); break; 
				default :  $this->___login(); break;
			}
		}catch(PDOException $e){
			throw new Exception( $e->getMessage() );
		}
	}
	private function ___login(){
		$data =[
			'email'=>$this->input->get('email'),
			'password'=>$this->input->get('password')
		];
		if(!Validasi::_array($data,'email|password')){
			throw new Exception(' Access token : Fail generate access token , email & password are required !!! ');
		}
		DB::koneksi();
		$user = DB::table(KODE .'pengguna')->select(DB::raw('userid ,passnya'))
			->where('username',$data['email'] )->orWhere('email',$data['email'])
			->limit(1)->first();
		if(empty($user))
			throw new Exception(' Fail generate access token : Username & Password doesnt Match !!! ');
		if (!password_verify($data['password'], $user['passnya'] ))
			throw new Exception(' Fail generate access token : Username & Password doesnt Match !!! ');
		Resp::set([
			'accesstoken'=>App\Api\AccesstokenCreate::init()->create([ 'userid'=>$user['userid'] ])
		]);
	}
	private function ___read(){
		AT::init()->read();
		Resp::set( 
			AT::init()->userdata()
		);
	}
}