		<!--[if !IE]>-->

				<script src="<?php echo $asset; ?>plugins/a/jquery-2.1.1.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>

			<script src="<?php echo $asset; ?>plugins/a/jquery-2.1.1.min.js"></script>

		<![endif]-->

		
		<script src="<?php echo $asset; ?>plugins/a/bootstrap.min.js"></script>
		
		<script>
		//loadCSS(helmi.asset +'plugins/slider/slide.css');
	var ajax_p =false;
	$('#login-box-inner').on('submit','form',function(e){
		e.preventDefault();
		var a = $(this);
		if( a.find('#loginmail').val() == '' ){
			a.find('#loginmail').focus(); return;
		}
		if( a.find('#loginpass').val() == '' ){
			a.find('#loginpass').focus(); return;
		}
		if(ajax_p)return; else ajax_p=true;
		$.ajax({
			type:'POST',dataType:'json',timeout:1700,data:a.serialize()
			,beforeSend:function(){
				$(".social-text").html("<img src='"+helmi.asset+"loading.gif' />");	
			},success:function(data){
				if(data.berhasil){
					$(".social-text").html('<div class="alert alert-success"><strong> SUCCESS : </strong> '+data.berhasil+' <button class="close" data-dismiss="alert">&times;</button></div>');
				}else if(data.error){
					$(".social-text").html('<div class="alert alert-danger"><strong> ERROR : </strong> '+data.error+' <button class="close" data-dismiss="alert">&times;</button></div>');
				}
				if(data.location){
					setTimeout(function(){
						window.document.location=helmi.home + data.location;
					},3000);
				}
			},complete:function(){
				ajax_p=false;
			}
		});
	});
	$('button.btn-success').click(function( ){
		$('#login-box-inner form').trigger('submit');
		
	}); 
	$(document).keypress(function(e ){
		if(e.keyCode == 13)$('#login-box-inner form').trigger('submit');
		
	});
	var cek_login=location.hash.replace(/^#/,"");
	if(cek_login.length > 5)window.document.location=helmi.home;
		
		
</script>
<?php

/*
		<!--[if !IE]>-->

			<script type="text/javascript">
				window.jQuery || document.write("<script src=\'<?php echo $asset; ?>plugins/a/jquery-2.1.1.min.js\'>"+"<"+"/script>");
			</script>

		<!--<![endif]-->

		<!--[if IE]>

			<script type="text/javascript">
		 	window.jQuery || document.write("<script src=\'<?php echo $asset; ?>real/js/jquery-1.11.1.min.js\'>"+"<"+"/script>");
			</script>

		<![endif]-->
*/