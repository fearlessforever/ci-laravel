<?php
namespace Proses;

use Proses\TraitConfig;
use Cache;
use DB;

class Login implements ProsesInterface{
	use TraitConfig;
	
	public function getVariabel():array
	{
		$pengaturan = $this->getConfig();
		$data=[
			'title'=> $pengaturan->title,
			'background'=> !empty($pengaturan->image) ?  $pengaturan->image : false ,
		];
		return $data;
	}
}