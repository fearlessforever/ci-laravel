<?php use Model\User; ?>
<header class="navbar" id="header-navbar">
	<div class="container">
	  <a href="<?php echo $__current; ?>" id="logo" class="navbar-brand">
		<img src="<?php echo $asset ?>sentor/img/logo.png" alt="" class="normal-logo logo-white"/>
		<img src="<?php echo $asset ?>sentor/img/logo-black.png" alt="" class="normal-logo logo-black"/>
		<img src="<?php echo $asset ?>sentor/img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
	  </a>
		<div class="clearfix">
			<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="fa fa-bars"></span>
			</button>
			<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
				<ul class="nav navbar-nav pull-left">
					<li>
						<a href="#" class="btn" id="make-small-nav">
						<i class="fa fa-bars"></i>
						</a>
					</li>
				</ul>
			</div>
		<div class="nav-no-collapse pull-right" id="header-nav">
			<ul class="nav navbar-nav pull-right">
				<li class="mobile-search">
					<a href="#"  class="btn">
						<i class="fa fa-search"></i>
					</a>
				<div class="drowdown-search">
					<form role="search">
						<div class="form-group">
						<input type="text" class="form-control" placeholder="Search...">
						<i class="fa fa-search nav-search-icon"></i>
						</div>
					</form>
				</div>
				</li>
				<li class="hidden-xs"><span class="timer"><i class="fa fa-clock-o"></i> <span id="clock"></span></span></li>
<?php /* <li class="dropdown hidden-xs">
					<a href="#"  class="btn dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-warning"></i>
					<span class="count">8</span>
					</a>
					<ul class="dropdown-menu notifications-list">
						<li class="pointer">
							<div class="pointer-inner">
								<div class="arrow"></div>
							</div>
						</li>
						<li class="item-header">You have 6 new notifications</li>
						<li class="item">
							<a href="#">
							<i class="fa fa-comment"></i>
							<span class="content">New comment on 'Awesome P...</span>
							<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-plus"></i>
								<span class="content">New user registration</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-envelope"></i>
								<span class="content">New Message from George</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-shopping-cart"></i>
								<span class="content">New purchase</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-eye"></i>
								<span class="content">New order</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
						</a>
						</li>
						<li class="item-footer">
							<a href="#">
								View all notifications
							</a>
						</li>
					</ul>
				</li> */ ?>
				<li class="dropdown hidden-xs">
					<a href="#"  class="btn dropdown-toggle" data-toggle="dropdown" data-tombolz="msg-notif" status="status">
						<i class="fa fa-warning"></i>
					</a>
					<ul class="dropdown-menu notifications-list messages-list">
						<li class="pointer">
							<div class="pointer-inner">
								<div class="arrow"></div>
							</div>
						</li>
						<li class="item"> <a href="#"> Tidak Ada Notifikasi Baru </a> </li>
					</ul>
				</li>
				
				<li class="hidden-xs">
					<a href="#" data-klik="systems.html"  class="btn">
						<i class="fa fa-cog"></i>
					</a>
				</li>
				<li class="dropdown profile-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img title="<?php echo User::$data['nama']; ?>" src="<?php echo (isset(User::$data['extra']['folder']) && isset(User::$data['extra']['profile_pic']) )? $asset . User::$data['extra']['folder'] . User::$data['extra']['profile_pic'] .'?_='.time() : $asset .'noimage.jpg' ; ?>" alt=""/>
						<span class="hidden-xs" style="max-width:100px; max-height:30px; overflow-x:hidden;"><?php echo User::$data['nama']; ?></span> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#" data-klik="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
						<li><a href="#" data-klik="systems.html"><i class="fa fa-cog"></i>Settings</a></li>
						<li><a href="<?php echo $home ?>logout.html" target="_top" ><i class="fa fa-power-off"></i>Logout</a></li>
					</ul>
				</li>
				<li class="hidden-xxs">
					<a  href="<?php echo $home ?>logout.html" target="_top" class="btn">
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
		</div>
		</div>
	</div>
</header>
<div id="status-nya-info" > </div>