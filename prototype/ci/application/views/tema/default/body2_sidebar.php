<?php
	use Model\User;
	$_icons =array(
		'fa fa-dashboard','fa fa-table','fa fa-envelope','fa fa-bar-chart-o','fa fa-th-large','fa fa-desktop','fa fa-edit','fa fa-map-marker','fa fa-file-text-o','fa fa-university'
	);
	$_sidebars=array(
		array('url'=>'dashboard.html','ket'=>'Dashboard')
		,array('url'=>'#','ket'=>'System','sub'=>array(array('url'=>'manage-user.html','ket'=>'<i class="fa fa-user"></i> User Management'),array('url'=>'manage-app.html','ket'=>'<i class="fa fa-recycle"></i> App Management') ))
		,array('url'=>'sys-info.html','ket'=>'Info : {memory_usage}')
	);
	$_sidebars = isset($sys_sidebar) ? json_decode($sys_sidebar['isi1'],TRUE) : $_sidebars ;
?>
<div id="nav-col">
	<section id="col-left" class="col-left-nano">
		<div id="col-left-inner" class="col-left-nano-content">
			<div id="user-left-box" class="clearfix hidden-sm hidden-xs">
				<img alt="" src="<?php echo (isset(User::$data['extra']['folder']) && isset(User::$data['extra']['profile_pic']) )? $asset . User::$data['extra']['folder'] . User::$data['extra']['profile_pic'].'?_='.time() : $asset .'noimage.jpg' ; ?>"/>
				<div class="user-box">
					<span class="name" style="max-width:90px!important; max-height:100px; overflow-x:hidden;"> Welcome<br/> <span ><?php echo User::$data['nama_d']; ?></span> </span>
					<span class="status"> <i class="fa fa-circle"></i> Online </span>
				</div>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
				<ul class="nav nav-pills nav-stacked">
<?php

	if(isset($_sidebars[0]) && is_array($_sidebars)){
		$_loc ='';
		foreach($_sidebars as $val){
			if(isset($val['sub']) && is_array($val['sub'])){
				$_loc2='';
				foreach($val['sub'] as $val2){
					$__check = str_replace('.html','',$val2['url']) ;
					if(!isset(User::$data['modul'][$__check  ]) && User::$data['level'] != 'admin')continue;
					$_loc2 .='<li><a href="#'.$val2['url'].'"><span>'.$val2['ket'].'</span></a></li> ';			
				}
				if($_loc2 =='')continue;
				$_loc .='<li><a href="#" class="dropdown-toggle" ><i class="'.$_icons[rand(1,9)].'"></i><span>'.$val['ket'].'</span><i class="fa fa-chevron-circle-right drop-icon"></i></a>'.( ($_loc2 =='' ? '' : '<ul class="submenu">'.$_loc2.'</ul>')).'</li>';
			}else{
				$_loc .='<li><a href="#'.$val['url'].'"><i class="'.$_icons[rand(1,9)].'"></i><span>'.$val['ket'].'</span></a></li> ';
	//<span class="label label-info label-circle pull-right">28</span>
			}
		}
		echo $_loc; $_loc=null;
	}
?>
					
				</ul>
			</div>
		</div>
	</section>
</div>