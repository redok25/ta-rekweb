	<?php include "template/header.php"; ?>
	<?php include "template/navbar.php"; ?>

	<div class="sidebar">
		<button class="sidebar-btn"><i class="fa fa-angle-left"></i></button>
		<?php if (isset($_SESSION['user'])): ?>
			<button class="btn btn-primary btn-block" onclick="addMarker()"><i class="fa fa-plus"></i> Tambah Marker</button>
			<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-delete" ><i class="fa fa-times"></i> Hapus Marker</button>
			<button class="btn btn-primary btn-block" onclick="showCostum()" ><i class="fa fa-map-marker-alt"></i> Lihat Costum Marker</button>
		<?php endif ?>
		<button class="btn btn-primary btn-block" onclick="showRumahSakit()"><i class="fa fa-hospital"></i> Rumah Sakit</button>
		<button class="btn btn-primary btn-block" onclick="showSaranaIbadah()"><i class="fa fa-mosque"></i> Masjid</button>
		<button class="btn btn-primary btn-block" onclick="showMakam()"><i class="fa fa-tombstone-alt"></i> Makam</button>
		<button class="btn btn-primary btn-block" onclick="reset()"><i class="fa fa-refresh"></i> Reset Marker</button>
	</div>

	<div class="container-fluid top20px">
		<div class="row">
			<div>
				<div id="map-view" style="top: 0; bottom: 0; width: 100%; height: 96vh" ></div>
			</div>
		</div>
	</div>

	<?php include "template/footer.php"; ?>

	 <script>
		const sidebar = document.querySelector('.sidebar');
		const btnSdbr = document.querySelector('.fa-angle-left');

		document.querySelector('.sidebar-btn').onclick = function () {
		  sidebar.classList.toggle('sidebar_small');
		  btnSdbr.classList.toggle('fa-angle-right')
		  btnSdbr.classList.toggle('fa-angle-left')
		}
		
		mapboxgl.accessToken = 'pk.eyJ1IjoicmVkb2syNSIsImEiOiJja3ZxOGxrdjI0NDhpMnVxZnB5cmZvbTdhIn0.BexWaptf8QYfClgq9iSuiQ';
			const map = new mapboxgl.Map({
			container: 'map-view', // container ID
			style: 'mapbox://styles/mapbox/dark-v10', // style URL
			center: [110.36444, -7.80139], // starting position [lng, lat]
			zoom: 12 // starting zoom
		});

		<?php if (isset($_SESSION['user'])): ?>
		let costumMaker = <?php echo json_encode($emparray); ?>	
		<?php endif ?>
		
		let jum = dataKoor['features'].length
		let jum1 = dataRumahSakit['features'].length

		var colors = ['#e3e8ea', '#bccad0', '#9ba8ae', '#707a7e', '#495054'];

		function register() {
			$('#modal-login').modal('hide'); 
			$('#modal-register').modal('show'); 
		}

		function getRandomInt(min, max) {
		    min = Math.ceil(min);
		    max = Math.floor(max);
		    return Math.floor(Math.random() * (max - min + 1)) + min;
		}

		function dataStatistik(data, kawasan) {
			var chart = Highcharts.chart('statistik', {
				chart: {
					type: 'line',
					style: { fontFamily: 'PT Sans'}
				},
				title: {
					text: 'Statistik Kependudukan di Kecamatan ' + kawasan + ' Tahun 2008 - 2016'
				},
				subtitle: {
					text: 'Sumber: Portal Data Bandung'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				xAxis: {
					categories: ['2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016'],
					title: {
						text: 'Tahun'
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Jumlah Penduduk'
					}
				},
				series: [{
					name: 'Jumlah Populasi',
					data: [
						data.pop_2008,
						data.pop_2009, 
						data.pop_2010, 
						data.pop_2011, 
						data.pop_2012, 
						data.pop_2013, 
						data.pop_2014, 
						data.pop_2015,
						data.pop_2016
					]
				},
				{
					name: 'Jumlah Kepadatan Penduduk (km2)',
					data: [
						data.pdt_2008, 
						data.pdt_2009, 
						data.pdt_2010, 
						data.pdt_2011, 
						data.pdt_2012, 
						data.pdt_2013, 
						data.pdt_2014, 
						data.pdt_2015,
						data.pdt_2016
					]
				},
				{
					name: 'Jumlah Populasi Pria',
					data: [
						data.pop_pria_2008, 
						data.pop_pria_2009, 
						data.pop_pria_2010, 
						data.pop_pria_2011, 
						data.pop_pria_2012, 
						data.pop_pria_2013, 
						data.pop_pria_2014, 
						data.pop_pria_2015,
						data.pop_pria_2016
					],
					visible: false
				},
				{
					name: 'Jumlah Kepadatan Penduduk Pria (km2)',
					data: [
						data.pdt_pria_2008, 
						data.pdt_pria_2009, 
						data.pdt_pria_2010, 
						data.pdt_pria_2011, 
						data.pdt_pria_2012, 
						data.pdt_pria_2013, 
						data.pdt_pria_2014, 
						data.pdt_pria_2015,
						data.pdt_pria_2016
					],
					visible: false
				},
				{
					name: 'Jumlah Populasi Wanita',
					data: [
						data.pop_wanita_2008,
						data.pop_wanita_2009,
						data.pop_wanita_2010,
						data.pop_wanita_2011,
						data.pop_wanita_2012,
						data.pop_wanita_2013,
						data.pop_wanita_2014,
						data.pop_wanita_2015,
						data.pop_wanita_2016
					],
					visible: false
				},
				{
					name: 'Jumlah Kepadatan Penduduk Wanita (km2)',
					data: [
						data.pdt_wanita_2009, 
						data.pdt_wanita_2009, 
						data.pdt_wanita_2010, 
						data.pdt_wanita_2011, 
						data.pdt_wanita_2012, 
						data.pdt_wanita_2013, 
						data.pdt_wanita_2014, 
						data.pdt_wanita_2015,
						data.pdt_wanita_2016
					],
					visible: false
				}]
			});

			return chart;
		}

		map.on('load', () => {
			for(let i = 0; i < jum ; i++){
				// Add a data source containing GeoJSON data.
				map.addSource(dataKoor["features"][i]["properties"]['NAMOBJ']+i, {
					'type': 'geojson',
					'data': {
						'type': 'Feature',
						'geometry': {
							'type': 'Polygon',
							'coordinates': 
							dataKoor["features"][i]["geometry"]["coordinates"]
						}
					}
				});
			 
				// Add a new layer to visualize the polygon.
				map.addLayer({
					'id': dataKoor["features"][i]["properties"]['NAMOBJ']+i,
					'type': 'fill',
					'source': dataKoor["features"][i]["properties"]['NAMOBJ']+i, // reference the data source
					'layout': {},
					'paint': {
						'fill-color': colors[getRandomInt(0,4)], // blue color fill
						'fill-opacity': 0.5
					}
				});

				// Add a black outline around the polygon.
				map.addLayer({
					'id': 'outline'+i,
					'type': 'line',
					'source':  dataKoor["features"][i]["properties"]['NAMOBJ']+i,
					'layout': {},
					'paint': {
					'line-color': 'white',
					'line-width': .5
					}
				});

				map.on('click', dataKoor["features"][i]["properties"]['NAMOBJ']+i, (e) => {
					// $("#modal-map .modal-body").html('<h5 style="line-height:2em">Kecamatan: '+dataKoor["features"][i]["properties"]['NAMOBJ']+' <br>Kelurahan: '+dataKoor["features"][i]["properties"]['WADMKC']+' <br>Kota: Yogyakarta<br>Provinsi: Daerah Istimewa Yogyakarta</h5>');

					$.getJSON('js/data-dummy.json', function (result) {
					var resultLength = result.length;
					var randomInt = getRandomInt(0, 29);
					for (var j = 0 ; j < resultLength; j++) {
						if (j == randomInt) {
							dataStatistik(result[j], dataKoor["features"][i]["properties"]['NAMOBJ']);

							$('#namaKecamatan').text('Demografi Kependudukan & Pendidikan di Kecamatan ' + dataKoor["features"][i]["properties"]['NAMOBJ']);

							$('#luasWilayah').text(result[j].luas_wilayah);
							$('#kawasan').text(dataKoor["features"][i]["properties"]['WADMKC']);
							$('#populasi').text(accounting.formatNumber(result[j].pop_2016, 0, '.'));
							$('#jumlahKelurahan').text(result[j].jumlah_kelurahan);

							$('#jumlahSD').text(accounting.formatNumber(result[j].jml_sd, 0, '.'));
							$('#jumlahSMP').text(accounting.formatNumber(result[j].jml_smp, 0, '.'));
							$('#jumlahSMA').text(accounting.formatNumber(result[j].jml_sma, 0, '.'));
							$('#jumlahSMK').text(accounting.formatNumber(result[j].jml_smk, 0, '.'));
							$('#jumlahKeaksaraan').text(accounting.formatNumber(result[j].jml_keaksaraan, 0, '.'));

							$('#usiaSD').text(accounting.formatNumber(result[j].umur_7_12, 0, '.'));
							$('#usiaSMP').text(accounting.formatNumber(result[j].umur_13_15, 0, '.'));
							$('#usiaSMA').text(accounting.formatNumber(result[j].umur_16_18, 0, '.'));

							$('#jumlahPtkSD').text(accounting.formatNumber(result[j].jml_ptk_sd, 0, '.'));
							$('#jumlahPtkSMP').text(accounting.formatNumber(result[j].jml_ptk_smp, 0, '.'));
							$('#jumlahPtkSMA').text(accounting.formatNumber(result[j].jml_ptk_sma, 0, '.'));
							$('#jumlahPtkSMK').text(accounting.formatNumber(result[j].jml_ptk_smk, 0, '.'));
							$('#jumlahPtkKeaksaraan').text(accounting.formatNumber(result[j].jml_ptk_keaksaraan, 0, '.'));

							$('#jumlahPdSD').text(accounting.formatNumber(result[j].jml_pd_sd, 0, '.'));
							$('#jumlahPdSMP').text(accounting.formatNumber(result[j].jml_pd_smp, 0, '.'));
							$('#jumlahPdSMA').text(accounting.formatNumber(result[j].jml_pd_sma, 0, '.'));
							$('#jumlahPdSMK').text(accounting.formatNumber(result[j].jml_pd_smk, 0, '.'));
							$('#jumlahPdKeaksaraan').text(accounting.formatNumber(result[j].jml_pd_keaksaraan, 0, '.'));
						};
					}
				});

					$('#modal-map').modal('show'); 
				});

				map.on('mouseenter', dataKoor["features"][i]["properties"]['NAMOBJ']+i, function (e) {
					// Change the cursor style as a UI indicator.
					map.getCanvas().style.cursor = 'pointer';
					map.setPaintProperty('outline'+i, 'line-width', 5);
					
				});

				map.on('mouseleave', dataKoor["features"][i]["properties"]['NAMOBJ']+i, () => {
					map.getCanvas().style.cursor = '';
					map.setPaintProperty('outline'+i, 'line-width', .5);
				});
			}
		});

		let rumahSakit = false;
		let kantorPos = false;
		let pendidikan = false;
		let kostum = false;
		let cc;

		function showRumahSakit() {
			if (kantorPos) {$( ".masjid" ).remove(); kantorPos = false;}
			if (pendidikan) {$( ".makam" ).remove(); pendidikan = false}
			if (kostum) {$( ".marker" ).remove(); kostum = false}


			if(document.getElementsByClassName('rumah-sakit').length == 0){
				$('#modal-map').remove();
				for (let i = 0; i < jum1 ; i++) {
					// create a HTML element for each feature
					const el = document.createElement('div');
					el.className = 'rumah-sakit';
					 
					// make a marker for each feature and add it to the map
					new mapboxgl.Marker(el)
					.setLngLat(dataRumahSakit["features"][i]["geometry"]["coordinates"])
					.setPopup(
					
					new mapboxgl.Popup({offset: 25}) // add popups
						.setHTML(
							`<h5>Rumah Sakit `+(i+1)+`</h5>`
						)
					)
					.addTo(map)
				}
				rumahSakit = true;
			}else {
				$( ".rumah-sakit" ).remove();
				document.getElementById('tempat-nih').insertAdjacentHTML('afterend', `
				<div class="modal fade" id="modal-map" data-backdrop="static">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
								</h4>
							</div>

							<!-- Demografi Kependudukan -->
							<div class="modal-body">
								<div role="tabpanel">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
										</li>
										<li role="presentation">
											<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
										</li>
										<li role="presentation">
											<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
										</li>
										<li role="presentation">
											<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
										</li>
										<li role="presentation">
											<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
										</li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content" style="margin-top: 1em">
										<div role="tabpanel" class="tab-pane active" id="kependudukan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-3">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="populasi"></h1>
													<p>Jumlah Penduduk (2016)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-globe fa-4x"></i>
													<h1 id="luasWilayah"></h1>
													<p>Luas Wilayah (Km<sup>2</sup>)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-map fa-4x"></i>
													<h1 id="kawasan"></h1>
													<p>Kawasan</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKelurahan"></h1>
													<p>Jumlah Kelurahan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
											<!-- Line Graph Populasi dan Kepdatan Penduduk -->
											<div class="text-center">
												<div id="statistik"></div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="usiaSekolah">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<img src="image/osis_sd.png" height="80px">
													<h1 id="usiaSD"></h1>
													<p>Usia SD (7-12 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMP"></h1>
													<p>Usia SMP (13-15 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMA"></h1>
													<p>Usia SMA (16-18 Tahun)</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahDasar">
											<!-- Jumlah Sekolah -->
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSD"></h1>
													<p>Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSD"></h1>
													<p>PTK Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSD"></h1>
													<p>Peserta Didik<br/>Sekolah Dasar</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMP"></h1>
													<p>Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMP"></h1>
													<p>PTK Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMP"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMA"></h1>
													<p>Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMA"></h1>
													<p>PTK Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMA"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMK"></h1>
													<p>Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMK"></h1>
													<p>PTK Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMK"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKeaksaraan"></h1>
													<p>Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkKeaksaraan"></h1>
													<p>PTK Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdKeaksaraan"></h1>
													<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<p class="text-muted text-center">
									Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
								</p>
							</div>
						</div>
					</div>
				</div>
				`)
				rumahSakit = false;
			}
		}
		function showSaranaIbadah() {
			if (rumahSakit) {$( ".rumah-sakit" ).remove(); rumahSakit = false}
			if (pendidikan) {$( ".makam" ).remove(); pendidikan = false}
			if (kostum) {$( ".marker" ).remove(); kostum = false}


			if(document.getElementsByClassName('masjid').length == 0){
				$('#modal-map').remove();
				kantorPos = true;
				for (let i = 0; i < dataIbadah["features"].length ; i++) {
					// create a HTML element for each feature
					const el = document.createElement('div');
					el.className = 'masjid';
					 
					// make a marker for each feature and add it to the map
					new mapboxgl.Marker(el)
					.setLngLat(dataIbadah["features"][i]["geometry"]["coordinates"])
					.setPopup(
					
					new mapboxgl.Popup({offset: 25}) // add popups
						.setHTML(
							`<h5>Masjid `+(i+1)+`</h5>`
						)
					)
					.addTo(map)
				}
			}else {
				$( ".masjid" ).remove();
				document.getElementById('tempat-nih').insertAdjacentHTML('afterend', `
				<div class="modal fade" id="modal-map" data-backdrop="static">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
								</h4>
							</div>

							<!-- Demografi Kependudukan -->
							<div class="modal-body">
								<div role="tabpanel">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
										</li>
										<li role="presentation">
											<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
										</li>
										<li role="presentation">
											<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
										</li>
										<li role="presentation">
											<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
										</li>
										<li role="presentation">
											<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
										</li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content" style="margin-top: 1em">
										<div role="tabpanel" class="tab-pane active" id="kependudukan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-3">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="populasi"></h1>
													<p>Jumlah Penduduk (2016)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-globe fa-4x"></i>
													<h1 id="luasWilayah"></h1>
													<p>Luas Wilayah (Km<sup>2</sup>)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-map fa-4x"></i>
													<h1 id="kawasan"></h1>
													<p>Kawasan</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKelurahan"></h1>
													<p>Jumlah Kelurahan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
											<!-- Line Graph Populasi dan Kepdatan Penduduk -->
											<div class="text-center">
												<div id="statistik"></div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="usiaSekolah">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<img src="image/osis_sd.png" height="80px">
													<h1 id="usiaSD"></h1>
													<p>Usia SD (7-12 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMP"></h1>
													<p>Usia SMP (13-15 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMA"></h1>
													<p>Usia SMA (16-18 Tahun)</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahDasar">
											<!-- Jumlah Sekolah -->
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSD"></h1>
													<p>Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSD"></h1>
													<p>PTK Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSD"></h1>
													<p>Peserta Didik<br/>Sekolah Dasar</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMP"></h1>
													<p>Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMP"></h1>
													<p>PTK Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMP"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMA"></h1>
													<p>Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMA"></h1>
													<p>PTK Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMA"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMK"></h1>
													<p>Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMK"></h1>
													<p>PTK Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMK"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKeaksaraan"></h1>
													<p>Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkKeaksaraan"></h1>
													<p>PTK Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdKeaksaraan"></h1>
													<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<p class="text-muted text-center">
									Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
								</p>
							</div>
						</div>
					</div>
				</div>
				`)
				kantorPos = false;
			}
		}
		function showMakam() {
			if (rumahSakit) {$( ".masjid" ).remove(); rumahSakit = false}
			if (kantorPos) {$( ".masjid" ).remove(); kantorPos = false}
			if (kostum) {$( ".marker" ).remove(); kostum = false}


			if(document.getElementsByClassName('makam').length == 0){
				$('#modal-map').remove();
				pendidikan = true;
				for (let i = 0; i < jum1 ; i++) {
					// create a HTML element for each feature
					const el = document.createElement('div');
					el.className = 'makam';
					 
					// make a marker for each feature and add it to the map
					new mapboxgl.Marker(el)
					.setLngLat(dataMakam["features"][i]["geometry"]["coordinates"])
					.setPopup(
					
					new mapboxgl.Popup({offset: 25}) // add popups
						.setHTML(
							`<h5>Makam `+(i+1)+`</h5>`
						)
					)
					.addTo(map)
				}
			}else {
				$( ".makam" ).remove();
				document.getElementById('tempat-nih').insertAdjacentHTML('afterend', `
				<div class="modal fade" id="modal-map" data-backdrop="static">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
								</h4>
							</div>

							<!-- Demografi Kependudukan -->
							<div class="modal-body">
								<div role="tabpanel">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
										</li>
										<li role="presentation">
											<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
										</li>
										<li role="presentation">
											<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
										</li>
										<li role="presentation">
											<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
										</li>
										<li role="presentation">
											<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
										</li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content" style="margin-top: 1em">
										<div role="tabpanel" class="tab-pane active" id="kependudukan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-3">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="populasi"></h1>
													<p>Jumlah Penduduk (2016)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-globe fa-4x"></i>
													<h1 id="luasWilayah"></h1>
													<p>Luas Wilayah (Km<sup>2</sup>)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-map fa-4x"></i>
													<h1 id="kawasan"></h1>
													<p>Kawasan</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKelurahan"></h1>
													<p>Jumlah Kelurahan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
											<!-- Line Graph Populasi dan Kepdatan Penduduk -->
											<div class="text-center">
												<div id="statistik"></div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="usiaSekolah">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<img src="image/osis_sd.png" height="80px">
													<h1 id="usiaSD"></h1>
													<p>Usia SD (7-12 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMP"></h1>
													<p>Usia SMP (13-15 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMA"></h1>
													<p>Usia SMA (16-18 Tahun)</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahDasar">
											<!-- Jumlah Sekolah -->
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSD"></h1>
													<p>Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSD"></h1>
													<p>PTK Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSD"></h1>
													<p>Peserta Didik<br/>Sekolah Dasar</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMP"></h1>
													<p>Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMP"></h1>
													<p>PTK Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMP"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMA"></h1>
													<p>Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMA"></h1>
													<p>PTK Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMA"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMK"></h1>
													<p>Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMK"></h1>
													<p>PTK Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMK"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKeaksaraan"></h1>
													<p>Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkKeaksaraan"></h1>
													<p>PTK Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdKeaksaraan"></h1>
													<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<p class="text-muted text-center">
									Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
								</p>
							</div>
						</div>
					</div>
				</div>
				`)
				pendidikan = false;
			}
		}
		function reset() {
			$( ".mapboxgl-marker" ).remove();
			if (rumahSakit || kantorPos || pendidikan || kostum) {
				document.getElementById('tempat-nih').insertAdjacentHTML('afterend', `
				<div class="modal fade" id="modal-map" data-backdrop="static">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
								</h4>
							</div>

							<!-- Demografi Kependudukan -->
							<div class="modal-body">
								<div role="tabpanel">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
										</li>
										<li role="presentation">
											<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
										</li>
										<li role="presentation">
											<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
										</li>
										<li role="presentation">
											<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
										</li>
										<li role="presentation">
											<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
										</li>
										<li role="presentation">
											<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
										</li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content" style="margin-top: 1em">
										<div role="tabpanel" class="tab-pane active" id="kependudukan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-3">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="populasi"></h1>
													<p>Jumlah Penduduk (2016)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-globe fa-4x"></i>
													<h1 id="luasWilayah"></h1>
													<p>Luas Wilayah (Km<sup>2</sup>)</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-map fa-4x"></i>
													<h1 id="kawasan"></h1>
													<p>Kawasan</p>
												</div>
												<div class="col-md-3">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKelurahan"></h1>
													<p>Jumlah Kelurahan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
											<!-- Line Graph Populasi dan Kepdatan Penduduk -->
											<div class="text-center">
												<div id="statistik"></div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="usiaSekolah">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<img src="image/osis_sd.png" height="80px">
													<h1 id="usiaSD"></h1>
													<p>Usia SD (7-12 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMP"></h1>
													<p>Usia SMP (13-15 Tahun)</p>
												</div>
												<div class="col-md-4">
													<img src="image/osis_sma.png" height="80px">
													<h1 id="usiaSMA"></h1>
													<p>Usia SMA (16-18 Tahun)</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahDasar">
											<!-- Jumlah Sekolah -->
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSD"></h1>
													<p>Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSD"></h1>
													<p>PTK Sekolah Dasar</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSD"></h1>
													<p>Peserta Didik<br/>Sekolah Dasar</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMP"></h1>
													<p>Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMP"></h1>
													<p>PTK Sekolah Menengah Pertama</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMP"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMA"></h1>
													<p>Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMA"></h1>
													<p>PTK Sekolah Menengah Atas</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMA"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahSMK"></h1>
													<p>Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkSMK"></h1>
													<p>PTK Sekolah Menengah Kejuruan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdSMK"></h1>
													<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
											<div class="row text-center inner-tab-modal">
												<div class="col-md-4">
													<i class="fa fa-fw fa-home fa-4x"></i>
													<h1 id="jumlahKeaksaraan"></h1>
													<p>Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-user fa-4x"></i>
													<h1 id="jumlahPtkKeaksaraan"></h1>
													<p>PTK Sekolah Keaksaraan</p>
												</div>
												<div class="col-md-4">
													<i class="fa fa-fw fa-users fa-4x"></i>
													<h1 id="jumlahPdKeaksaraan"></h1>
													<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<p class="text-muted text-center">
									Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
								</p>
							</div>
						</div>
					</div>
				</div>
				`)
			}
			rumahSakit = false;
			kantorPos = false;
			pendidikan = false;
			kostum = false;
		}
		<?php if (isset($_SESSION['user'])): ?>
		function showCostum() {
			if (costumMaker['length'] == 0) {
				$.alert({
				    title: 'Notifikasi',
				    content: 'Costum maker tidak ada!',
				    icon: 'fa fa-times',
				    theme: 'modern',
				    type: 'red'
				});
			}else{
				if (rumahSakit) {$( ".rumah-sakit" ).remove(); rumahSakit = false}
				if (kantorPos) {$( ".masjid" ).remove(); kantorPos = false}
				if (pendidikan) {$( ".makam" ).remove(); pendidikan = false}

				if(document.getElementsByClassName('marker').length == 0){
					$('#modal-map').remove();
					kostum = true;
					for (let i = 0; i < costumMaker['length'] ; i++) {
						let koor = [costumMaker[i]['lng'], costumMaker[i]['lnt']]
						// create a HTML element for each feature
						const el = document.createElement('div');
						el.className = 'marker';
						 
						// make a marker for each feature and add it to the map
						new mapboxgl.Marker(el)
						.setLngLat(koor)
						.setPopup(
						
						new mapboxgl.Popup({offset: 25}) // add popups
							.setHTML(
								`<h5>`+costumMaker[i]['nama']+`</h5>`
							)
						)
						.addTo(map)
					}
				}else {
					$( ".marker" ).remove();
					document.getElementById('tempat-nih').insertAdjacentHTML('afterend', `
					<div class="modal fade" id="modal-map" data-backdrop="static">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">
										<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
									</h4>
								</div>

								<!-- Demografi Kependudukan -->
								<div class="modal-body">
									<div role="tabpanel">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active">
												<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
											</li>
											<li role="presentation">
												<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
											</li>
											<li role="presentation">
												<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
											</li>
											<li role="presentation">
												<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
											</li>
											<li role="presentation">
												<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
											</li>
											<li role="presentation">
												<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
											</li>
											<li role="presentation">
												<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
											</li>
											<li role="presentation">
												<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
											</li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content" style="margin-top: 1em">
											<div role="tabpanel" class="tab-pane active" id="kependudukan">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-3">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="populasi"></h1>
														<p>Jumlah Penduduk (2016)</p>
													</div>
													<div class="col-md-3">
														<i class="fa fa-fw fa-globe fa-4x"></i>
														<h1 id="luasWilayah"></h1>
														<p>Luas Wilayah (Km<sup>2</sup>)</p>
													</div>
													<div class="col-md-3">
														<i class="fa fa-fw fa-map fa-4x"></i>
														<h1 id="kawasan"></h1>
														<p>Kawasan</p>
													</div>
													<div class="col-md-3">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahKelurahan"></h1>
														<p>Jumlah Kelurahan</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
												<!-- Line Graph Populasi dan Kepdatan Penduduk -->
												<div class="text-center">
													<div id="statistik"></div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="usiaSekolah">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<img src="image/osis_sd.png" height="80px">
														<h1 id="usiaSD"></h1>
														<p>Usia SD (7-12 Tahun)</p>
													</div>
													<div class="col-md-4">
														<img src="image/osis_sma.png" height="80px">
														<h1 id="usiaSMP"></h1>
														<p>Usia SMP (13-15 Tahun)</p>
													</div>
													<div class="col-md-4">
														<img src="image/osis_sma.png" height="80px">
														<h1 id="usiaSMA"></h1>
														<p>Usia SMA (16-18 Tahun)</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="sekolahDasar">
												<!-- Jumlah Sekolah -->
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahSD"></h1>
														<p>Sekolah Dasar</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-user fa-4x"></i>
														<h1 id="jumlahPtkSD"></h1>
														<p>PTK Sekolah Dasar</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="jumlahPdSD"></h1>
														<p>Peserta Didik<br/>Sekolah Dasar</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahSMP"></h1>
														<p>Sekolah Menengah Pertama</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-user fa-4x"></i>
														<h1 id="jumlahPtkSMP"></h1>
														<p>PTK Sekolah Menengah Pertama</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="jumlahPdSMP"></h1>
														<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahSMA"></h1>
														<p>Sekolah Menengah Atas</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-user fa-4x"></i>
														<h1 id="jumlahPtkSMA"></h1>
														<p>PTK Sekolah Menengah Atas</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="jumlahPdSMA"></h1>
														<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahSMK"></h1>
														<p>Sekolah Menengah Kejuruan</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-user fa-4x"></i>
														<h1 id="jumlahPtkSMK"></h1>
														<p>PTK Sekolah Menengah Kejuruan</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="jumlahPdSMK"></h1>
														<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
												<div class="row text-center inner-tab-modal">
													<div class="col-md-4">
														<i class="fa fa-fw fa-home fa-4x"></i>
														<h1 id="jumlahKeaksaraan"></h1>
														<p>Sekolah Keaksaraan</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-user fa-4x"></i>
														<h1 id="jumlahPtkKeaksaraan"></h1>
														<p>PTK Sekolah Keaksaraan</p>
													</div>
													<div class="col-md-4">
														<i class="fa fa-fw fa-users fa-4x"></i>
														<h1 id="jumlahPdKeaksaraan"></h1>
														<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<p class="text-muted text-center">
										Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
									</p>
								</div>
							</div>
						</div>
					</div>
					`)
					kostum = false;
				}
			}
		}
		function addMarker() {
			$('#modal-map').remove();
			$.alert({
			    title: 'Instruksi',
			    content: 'Silahkan klik lokasi yang ingin dibuat marker!',
			    icon: 'fa fa-info',
			    type: 'blue',
			    theme: 'modern',
			});
			if(document.getElementsByClassName('marker').length == 0){
				map.on('click', (e) => {
				    var coords = `lat: ${e.lngLat.lat} <br> lng: ${e.lngLat.lng}`;

				    // create the popup
				    var popup = new mapboxgl.Popup().setText(coords);

				    // create DOM element for the marker
				    var el = document.createElement('div');
				    el.id = 'marker';

				    cc = e.lngLat;

				    // create the marker
				    new mapboxgl.Marker(el)
				        .setLngLat(e.lngLat)
				        .setPopup(popup)
				        .addTo(map);

				    $.confirm({
					    title: 'Tambah Costum Marker',
					    content: '' +
					    '<form action="" class="formName">' +
					    '<div class="form-group">' +
					    '<label>Masukan nama lokasi marker</label>' +
					    '<input type="text" placeholder="Nama lokasi" class="name form-control" required />' +
					    '</div>' +
					    '</form>',
					    theme: 'modern',
					    buttons: {
					        formSubmit: {
					            text: 'Submit',
					            btnClass: 'btn-blue',
					            action: function () {
					                var name = this.$content.find('.name').val();
					                if(!name){
					                    $.alert('Inputan tidak boleh kosong!');
					                    return false;
					                }
					                window.location = "php-native/logic.php?pin="+cc+"&nama="+name;   
					            }
					        },
					        cancel: function () {
					            window.location = "index.php";
					        },
					    },
					    onContentReady: function () {
					        // bind to events
					        var jc = this;
					        this.$content.find('form').on('submit', function (e) {
					            // if the user submits the form by pressing enter in the field.
					            e.preventDefault();
					            jc.$$formSubmit.trigger('click'); // reference the button and click it
					        });
					    }
					});

					// var namePin = prompt("Masukan Nama Lokasi Marker");
					// while(!namePin){
					// 	var namePin = prompt("Masukan Nama Lokasi Marker");
					// };

					// window.location = "php-native/logic.php?pin="+cc+"&nama="+namePin;   
			  });
			}	
		}
		<?php endif ?>


    <?php if (isset($_SESSION['failed']) OR isset($_SESSION['success'])): ?>
    	<?php if (isset($_SESSION['failed'])): ?>
    		$.alert({
			    title: 'Notifikasi',
			    content: '<?php echo $_SESSION['failed'] ?>',
			    icon: 'fa fa-times',
			    theme: 'modern',
			    type: 'red'
			});
    	<?php endif ?>

    	<?php if (isset($_SESSION['success'])): ?>
    		$.alert({
			    title: 'Notifikasi',
			    content: '<?php echo $_SESSION['success'] ?>',
			    icon: 'fa fa-check',
			    theme: 'modern',
			    type: 'green'
			});
    	<?php endif ?>
        
        <?php 
            if (isset($_SESSION['failed'])) {
                unset($_SESSION['failed']); 
            }
            if (isset($_SESSION['success'])) {
                unset($_SESSION['success']);
            }
        ?>
    <?php endif ?>	

	</script>
</body>
</html>