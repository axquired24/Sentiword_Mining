<script type="text/javascript" src="./assets/js/smoothscroll.js"></script>
<style>
	@media (min-width: 768px) {
		.whitespace
		{
			height: 200px;
		}
	}
	body 
	{
		background: #F2F2F2 url("./assets/image/poly.jpg") repeat center center;
		background-attachment: fixed;
		padding-top: 60px;
		box-shadow: none;		
	}
	.page-header
	{
		border-bottom: #B9B9B9 2px solid;
	}
	h1.big
	{
		font-size: 7em;
	}
	p.lead
	{
		padding: 20px;
		text-indent: 2em;
		line-height: 1.5em;
		text-align: justify;
	}
	p.step
	{
		padding: 10px;
		font-size: 1.2em;
		margin-top: -20px;
	}	
	#how-to
	{
		background-color: #ECF2F2;
		opacity: 0.9;
		padding-bottom: 60px;
	}	
</style>
<div id="home" class="row">
	<div class="container">
		<h1 align="center" class="page-header big">
			<!-- <span class="glyphicon glyphicon-home pull-right text-primary"></span> -->
			Hi,
			<small>Selamat datang di sentinesia</small>
			<br>			
		</h1>
		<p class="lead">
			Sentinesia adalah situs penghitung nilai sentimen kalimat (sentiment word) berdasarkan kamus SentiWordNet v3.0.0 yang dirilis pada 1 Juni 2010 - (Sumber : <a class="link" href="http://sentiwordnet.isti.cnr.it">http://sentiwordnet.isti.cnr.it</a>). Pada saat ini sentinesia hanya dapat digunakan dalam bahasa indonesia dan inggris.
		</p>
		<div align="center">
			<a title="Mulai sekarang" href="./?p=try" class="btn btn-lg btn-primary">Mulai Sekarang</a>
		</div>

		<div class="whitespace"></div> <!-- whitespace -->
		
	</div> <!-- .container -->
</div> <!-- .row -->

<div id="how-to" class="row">
	<div class="container">
		<h2 class="page-header text-center">
			How to use : 
		</h2>	
		<div class="col-md-3">
			<h3>#Step 1</h3>
			<img src="./assets/image/how_to/step1.png" alt="sentinesia-step1" class="img-responsive thumbnail">
			<p class="step">#1 Pilih Menu <i>'Mining Sekarang'</i> pada navigasi <b>sentinesia</b>, tunggu hingga mengarah ke halaman <i>mining</i></p>
		</div>
		<div class="col-md-3">
			<h3>#Step 2</h3>
			<img src="./assets/image/how_to/step2.png" alt="sentinesia-step2" class="img-responsive thumbnail">
			<p class="step">#2 Pilih bahasa yang akan dimasukkan (saat ini <b>sentinesia</b> tersedia dalam <kbd>ID</kbd>:indonesia, <kbd>EN</kbd>:english)</p>
		</div>
		<div class="col-md-3">
			<h3>#Step 3</h3>
			<img src="./assets/image/how_to/step3.png" alt="sentinesia-step3" class="img-responsive thumbnail">
			<p class="step">#3 Pilih masukkan kalimat yang akan diproses oleh <b>sentinesia</b>. Kemudian klik tombol 'view result'.</p>
		</div>
		<div class="col-md-3">
			<h3>#Step 4</h3>
			<img src="./assets/image/how_to/step4.png" alt="sentinesia-step4" class="img-responsive thumbnail">
			<p class="step">#4 Yaps, hasil <i>mining</i> kalimat telah ditampilkan. Untuk melakukan mining lagi, silahkan kembali ke step 1.</p>
		</div>
	</div>	<!-- .container -->
</div> <!-- .row -->

<script>
	$("#nav-home").addClass("active");
</script>