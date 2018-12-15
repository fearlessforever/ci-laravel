@extends('layouts.core',['title'=>$title])

@push('scripts')
<script src="{{asset('js/func.js')}}" type="text/babel"></script>
<script type="text/babel">
(function($){
	const helmi={
		ajax:true,
		loginUrl:"{{route('page.login.json')}}",
		form:false,
	};
	
	$('#login-box-inner form').submit(function(e){
		e.preventDefault();
		if( !helmi.ajax)return;
		
		helmi.form =$(this);
		fetchAjax({
			url:helmi.loginUrl,
			dataType:'json',type:'POST',
			data: helmi.form.serialize(),
			beforeSend:function(){
				helmi.ajax=false; helmi.form.find('input,button').each(function(){
					$(this).attr('disabled','disabled');
				});
				$('button[type="submit"]').attr('disabled','disabled');
				$(".social-text").html(`<img src="{{asset('loading.gif')}}" />`);
			},
			complete:function(){
				helmi.ajax=true; 
				$(".social-text").html(``);
			},
		}).then((resp={})=> {
			if(resp.message){
			$(".social-text").html(`
				<div class="alert alert-success">
				<strong> Success : </strong> ${resp.message} <button class="close" data-dismiss="alert">&times;</button>
				</div>
			`);
			}
		}).catch( (error={}) =>{
			let { message=''} = error; 
			$(".social-text").html(`
				<div class="alert alert-danger">
				<strong> ERROR : </strong> ${message} <button class="close" data-dismiss="alert">&times;</button>
				</div>
			`);
			helmi.form.find('input,button').each(function(){
				$(this).removeAttr('disabled');
			});
			$('button[type="submit"]').removeAttr('disabled');
		});
	});
	
	$('button.btn-success').click(function( ){
		$('#login-box-inner form').trigger('submit');
		
	});
	
	$(document).keypress(function(e ){
		if(e.keyCode == 13)
			$('#login-box-inner form').trigger('submit');
		
	});
	
})(jQuery);
</script>
@endpush

@push('styles')
<style>
@if(isset($background) && $background)
	#login-full-wrapper{background:url({{asset($background)}}) ; background-position: right top; background-attachment: fixed;}
@endif

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
@endpush

@section('content')
<div id="login-full-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div id="login-box" class="tambahan">
					<div id="login-box-holder" >
						<div class="row">
						<div class="col-xs-12">
						<header id="login-header">
							<div id="login-logo">
							<img alt="" src="{{asset('img/logo.png')}}" />
							</div>
						</header>
						<div id="login-box-inner">
							<form action="" role="form">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input id="loginmail" name="username" type="text" placeholder="Username or Email" class="form-control" />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key"></i></span>
								<input id="loginpass" name="password" type="password" placeholder="Password" class="form-control">
							</div>
							<div id="remember-me-wrapper">
								<div class="row">
								<div class="col-xs-6">
									<div class="checkbox-nice">
										<input type="checkbox" id="remember-me" name="remember" > <label for="remember-me"> Remember me  </label>
									</div>
								</div>
								</div>
							</div>
							</form>
						<div class="row">
						<div class="col-xs-12">
							<button class="btn btn-success col-xs-12" type="submit"> Login </button>
						</div>
						</div> 
						<div class="row">
						<div class="col-xs-12 social-text">
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
@stop