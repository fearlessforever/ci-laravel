<?php
namespace Proses;
use Cache;
use Model\Pengaturan as Model;
use Data\Pengaturan;

trait TraitConfig {
	public function getConfig():Pengaturan
	{
		$webConfig = Cache::remember('config.db', now()->addMinutes(17) , function(){
			$getDB = Model::select(\DB::raw("
				nama as id , isi1, isi2
			"))->limit(17)->get();
			$data=[];
			foreach($getDB as $val){
				$data[$val->id]=[
					'content'=>$val->isi1,
					'value'=>$val->isi2 ,
				];
			}
			$pengaturan = loader(Pengaturan::class);
			$pengaturan->set($data);
			return $pengaturan;
		});
		return $webConfig;
	}
}

