<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Belajar API Alamat</title>
	<link rel="icon" type="image/png" href="assets/img/logo.jpg">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<script>

	</script>
</head>
<body>

	<nav class="navbar navbar-dark bg-primary">
		<a class="navbar-brand" href="#">OWLabs</a>
	</nav>

	
	<div class="container">
		<div style="margin-top: 30px">
			<h2> Belajar API Daerah Se-Indonesia  </h2> 
			<p>Menggunakan API yang dibuat oleh Dev. farizdotid</p>
			
			<hr>
		</div>
		<div class="row" style="margin-top: 20px">
			<div class="col-8">
				<form >
					<?php
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "GET",
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);
					
					 // echo $response;
					// $data = json_decode($response, true);

					echo "
					<div class= \"form-group\">
					<label for=\"provinsi\">Provinsi </label>
					<select class=\"form-control\" name='provinsi' id='provinsi'>";
					echo "<option>Pilih Provinsi</option>";

					$data = json_decode($response, true);
					for ($i=0; $i < count($data['semuaprovinsi']); $i++) {
						echo "<option value='".$data['semuaprovinsi'][$i]['id']."'>".$data['semuaprovinsi'][$i]['nama']."</option>";
					}
					echo "</select>
					</div>";
					?>
					<div class="form-group">
						<label for="kabupaten">Kabupaten</label>
						<select class="form-control" id="kabupaten" name="kabupaten"></select>
					</div>
					<div class="form-group">
						<label for="kecamatan">Kecematan</label>
						<select class="form-control" id="kecamatan" name="kecamatan"></select>
					</div>
					<div class="form-group">
						<label for="desa">Desa</label>
						<select class="form-control" id="desa" name="desa"></select>
					</div>
					
				</form>
				<button onclick="tampil();" class="btn btn-info" id="tampil" name="tampil" >Tampilkan</button>
			</div>
			<div class="col-3">
				<label for="hasil">Alamat Hasil :</label>
				<textarea  class="form-control" name="hasil" id="hasil" rows="12"></textarea>
			</div>
		</div>
		<hr>
		<div class="text-right">
			<p>Program By : AL Gzl</p>
		</div>
	</div>
	
	<script src="assets/js/JQuery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>

<script type="text/javascript">

	$(document).ready(function(){
		$('#provinsi').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();
			
			$.ajax({
				type : 'GET',
				url : 'kabupaten.php',
				data :  'prov_id=' + prov,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
			});
		});

		$('#kabupaten').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabupaten').val();
			
			$.ajax({
				type : 'GET',
				url : 'kecamatan.php',
				data :  'id_kabupaten=' + kab,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kecamatan").html(data);
				}
			});
		});

		$('#kecamatan').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#kecamatan').val();
			
			$.ajax({
				type : 'GET',
				url : 'desa.php',
				data :  'id_kecamatan=' + desa,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#desa").html(data);
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
		});
	});
	function tampil(){
			// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
			var prov = $('#provinsi option:selected').text();
			var kab = $('#kabupaten option:selected').text();
			var kec = $('#kecamatan option:selected').text();
			var des = $('#desa option:selected').text();
			document.getElementById("hasil").innerHTML = "Desa: "+ des +", Kecamatan: " + kec + ",  Kabupaten : "+kab+ ", Provinsi : " + prov;
		};
	</script>