<?php
namespace Data;
class Pengaturan{
	use TraitData;
	
	public function set( array $set ):void
	{
		foreach($set as $key => $variabel)
		{
			switch($key){
				case 'title': $this->data[$key]= isset($variabel['content']) ? $variabel['content'] : ''; break;
				case 'sys_hapus': $this->data['delete']= isset($variabel['content']) ? (bool)$variabel['content'] : false; break;
				case 'sys_notif': $this->data['notif']= isset($variabel['content']) ? (bool)$variabel['content'] : false; break;
				case 'sys_bg':
					$this->data['image']= !empty($variabel['content']) ?  trim($variabel['value'],'/').'/'.trim($variabel['content'],'/') : ''; break;
				default:break;
			}
		}
	}
}