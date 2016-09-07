<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active"><span>Dashboard</span></li>
				</ol>
				<h1>Dashboard</h1>
			</div>
		</div>		
		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix"> <h2 class="pull-left">Halaman Utama Setelah Login</h2>  </header>
					<div class="main-box-body">
						<p>Hello , ini adalah halaman utama Logged In area , file terletak di <strong style="color:red;">[application/views/system/dashboard_view.php ]</strong> </p>
						
						<p>Edit File ini sesuai Kebutuhan Aplikasi yang dibuat . Jika halaman ini membutuhkan proses , tambahkan file model untuk halaman ini <br>Misal : <strong style="color:red;">[application/models/system/dashboard_model.php ]</strong> </p>
						<p>Jika halaman ini membutuhan library javascript tertentu , file nya bisa diload dengan memanggil function <strong style="color:red;">loadJS(); </strong>  ,<br> dan file CSS yang dibutuhkan halaman ini diload dengan memanggil function <strong style="color:red;">loadCSS(); </strong><br>
						Disarankan selalu load file Javascript -> reset.js [<span style="color:red;">&lt;?php</span><span style="color:blue;"> echo $asset </span><span style="color:red;">?&gt;</span>js/reset.js] untuk menghilangkan event handler yang diterapkan di DOM , karna halaman tidak di reload , jadi sewaktu melakukan perubahan halaman menggunakan ajax , event handler yg di bind sebelum ny masih aktif.
						</p>
			<p>P.S : <br> Selalu sertakan line berikut di tag script file view <br><strong >helmi.controller ='<span style="color:red;">&lt;?php</span><span style="color:blue;"> echo isset($__controller)?$__controller:'';</span> <span style="color:red;">?&gt;</span>'; </strong> <br> Jika halaman ini membutuhkan proses ajax , value dari variabel controller ini perlu ditambahkan di url ajax </p>
						<p>Default nya file view seperti berikut :
<pre>
&lt;div class="row"&gt;
	&lt;div class="col-lg-12"&gt;
		&lt;ol class="breadcrumb"&gt;
			&lt;li&gt;&lt;a href="#"&gt;Home&lt;/a&gt;&lt;/li&gt;
			&lt;li class="active"&gt;&lt;span&gt;Dashboard&lt;/span&gt;&lt;/li&gt;
		&lt;/ol&gt;
		&lt;h1&gt;Dashboard&lt;/h1&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="row"&gt;
	&lt;div class="col-lg-12"&gt;
		&lt;div class="main-box"&gt;
			&lt;header class="main-box-header clearfix"&gt; &lt;h2 class="pull-left"&gt;Halaman Utama Setelah Login&lt;/h2&gt;  &lt;/header&gt;
			&lt;div class="main-box-body"&gt;
			<strong style="color:red;">CONTENT HALAMAN</strong>
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;script&gt;
<strong >helmi.controller ='<span style="color:red;">&lt;?php</span><span style="color:blue;"> echo isset($__controller)?$__controller:'';</span> <span style="color:red;">?&gt;</span>'; </strong>
<strong style="color:red;">loadCSS(" String url CSS asset ");</strong> <span style="color:green;"> Jika halaman ini memerlukan CSS tertentu</span>
loadJS([
	<strong>Array Dari string url Library Javascript yang akan diload [diperlukan halaman ini]</strong>
	Misal :
	"<span style="color:red;">&lt;?php</span><span style="color:blue;"> echo $asset </span><span style="color:red;">?&gt;</span>js/data-table-min.js"
	,"<span style="color:red;">&lt;?php</span><span style="color:blue;"> echo $asset </span><span style="color:red;">?&gt;</span>js/reset.js"
],'<strong>String URL javascript untuk proses halaman ini</strong>' ,'content-wrapper');
&lt;/script&gt;
</pre>
						</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script>
	helmi.controller ='<?php echo isset($__controller)?$__controller:''; ?>';
	
	//loadCSS("<?php echo $asset ?>css/blablabla.css");
	
	loadJS([
		"<?php echo $asset ?>js/reset.js"
	],"",'content-wrapper');
	
</script>