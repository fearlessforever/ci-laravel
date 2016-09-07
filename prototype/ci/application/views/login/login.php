<?php use Saya\Lang ; Lang::load( array('form') ); ?>

<style>
<?php 
echo (isset($sys_bg['isi1']) && isset($sys_bg['isi2'])) ?  'body{background:url('.$asset.$sys_bg['isi2'].$sys_bg['isi1'].') ; background-position: right top; background-attachment: fixed;}' : '';
?>
@media screen and (min-width: 1000px) {
	.tambahan{
		margin-top: 15px!important;
	}
}
ul#myCarousel{
	list-style: none;
	margin: 0;
	padding: 0;
	height: 0;
	padding-bottom: 75%;
	/* background-color: #333; */
	position: relative;
	overflow: hidden;
}
/* ul#myCarousel li:nth-child(n){
	 display:none;
}
ul#myCarousel li:first-child{
	 display:block!important;
} */
.slider-wrapper{
	margin:70px auto 5px; text-align:center;
	max-width:600px ; 
}
.slider-wrapper li img{
	border-radius:17px; width:100%; height:00%;
}
</style>
<div id="login-full-wrapperz">
	<div class="containerz">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div id="login-box" class="tambahan">
					<div id="login-box-holder" >
						<div class="row">
						<div class="col-xs-12">
						<header id="login-header">
						<div id="login-logo">
						<img alt="" src="<?php echo $asset; ?>sentor/img/logo.png">
						</div>
						</header>
						<div id="login-box-inner">
						<form action="" role="form">
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input id="loginmail" name="username" type="text" placeholder="<?php echo Lang::get('form_holder_user|email'); ?>" class="form-control">
						</div>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input id="loginpass" name="password" type="password" placeholder="<?php echo Lang::get('form_holder_password'); ?>" class="form-control">
						</div>
						<div id="remember-me-wrapper">
						<div class="row">
						<div class="col-xs-6">
							<div class="checkbox-nice">
								<input type="checkbox" id="remember-me" name="remember" > <label for="remember-me"> <?php echo Lang::get('form_text_remember'); ?> </label>
							</div>
						</div>
						</div>
						</div>
						</form>
						<div class="row">
						<div class="col-xs-12">
						<button class="btn btn-success col-xs-12" type="submit"> <?php echo Lang::get('form_text_login'); ?> </button>
						</div>
						</div> 
						<div class="row">
						<div class="col-xs-12">
						<p class="social-text"></p>
						</div>
						</div>
						<div class="row">
						 
						<div class="col-xs-12 col-sm-6">
						<a class="btn btn-primary col-xs-12 btn-facebook" target="_blank" href="http://www.facebook.com/fearlessforever">
						<i class="fa fa-facebook"></i> Facebook
						</a>
						</div>
						<div class="col-xs-12 col-sm-6">
							<a class="btn btn-primary col-xs-12 btn-twitter" target="_blank" href="http://www.facebook.com/fearlessforever"> <i class="fa fa-twitter"></i> Twitter </a>
						</div> 
						</div>
						
						</div>
						</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>