<div class="container-fluid top20px">
	<div class="row">
		<div>
			<div id="map-view" style="top: 0; bottom: 0; width: 100%; height: 96vh"></div>
		</div>
	</div>
</div>


<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoicmVkb2syNSIsImEiOiJja3ZxOGxrdjI0NDhpMnVxZnB5cmZvbTdhIn0.BexWaptf8QYfClgq9iSuiQ';
	const map = new mapboxgl.Map({
		container: 'map-view', // container ID
		style: 'mapbox://styles/mapbox/dark-v10', // style URL
		center: [115.46084709857999, -0.35012438562263526], // starting position [lng, lat]
		zoom: 4 // starting zoom
	});

	<?php if (isset($_SESSION['user'])) : ?>
		let costumMaker = <?php echo json_encode($emparray); ?>
	<?php endif ?>

	// var colors = ['#445C3C', '#445C3C', '#445C3C', '#445C3C', '#445C3C'];

	function register() {
		$('#modal-login').modal('hide');
		$('#modal-register').modal('show');
	}

	function getRandomInt(min, max) {
		min = Math.ceil(min);
		max = Math.floor(max);
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}


	map.on('load', () => {
		map.addSource('propinsi', {
			'type': 'geojson',
			'data': '<?= base_url() ?>assets/js/indonesia-province-simple.json'
		});

		// Add a layer showing the state polygons.
		map.addLayer({
			'id': 'propinsi-layer',
			'type': 'fill',
			'source': 'propinsi',
			'paint': {
				'fill-color': 'rgba(112,122,126, 0.5)',
				'fill-outline-color': 'rgba(255, 255, 255, 1)'
			}
		});

		map.on('click', 'propinsi-layer', (e) => {
			new mapboxgl.Popup()
				.setLngLat(e.lngLat)
				.setHTML(e.features[0].properties.Propinsi)
				.addTo(map);
		});

		map.on('mouseenter', 'propinsi-layer', () => {
			map.getCanvas().style.cursor = 'pointer';
		});

		map.on('mouseleave', 'propinsi-layer', () => {
			map.getCanvas().style.cursor = '';
		});

	});



	<?php if (isset($_SESSION['failed']) or isset($_SESSION['success'])) : ?>
		$(document).ready(function() {
			$("#notifikasi").modal('show');
		});
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