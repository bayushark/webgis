<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
   <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>
 <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.css" />
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />
 <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

 <script src="assets/js/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

   <script type="text/javascript">
    let latLng=[-7.433099, 112.712702];

   	var map = L.map('mapid').setView(latLng, 12);

   	var LayerKita= L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    });
	map.addLayer(LayerKita);
	
	
	function getLocation() {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition);
	  } else {
	    x.innerHTML = "Geolocation is not supported by this browser.";
	  }
	}

	function showPosition(position) {
	  $("[name=latNow]").val(position.coords.latitude);
	  $("[name=lngNow]").val(position.coords.longitude);
	   let latLng = [position.coords.latitude, position.coords.longitude];

		control.spliceWaypoints(0, 1, latLng);
		 map.panTo(latLng);
	}

	
	getLocation()

	var markers = L.markerClusterGroup();

	let distanceTo = [];
	
	let latitudeLongitude = []
	

<?php

if($tipe!='pilih tipe' ){
	$db->where('tipe','%'. $tipe,'LIKE');
	
}
if($jn_rs!='pilih jenis rumah sakit'){
	$db->where('jn_rs','%'. $jn_rs,'LIKE');
}
if ($nm_rs != 'pilih rumah sakit') {
	$db->where('nm_rs', '%' . $nm_rs, 'LIKE');
}



	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
			$getdata=$db->ObjectBuilder()->get('rs a');
			
			foreach ($getdata as $row) {	
			?>
			latitudeLongitude.push([<?= $row->lat ?>, <?= $row->lng ?>])
			markers.addLayer(L.marker([<?=$row->lat?>,<?=$row->lng?>])
			.bindPopup("Nama Rumah Sakit :<?=$row->nm_rs?><br>"+
                       "Alamat :<?=$row->alamat?>,"+
                       "Kec. <?=$row->nm_kecamatan?><br>"+
                       "Tipe :<?=$row->tipe?><br>"+
					   "Jenis Rumah Sakit :<?=$row->jn_rs?><br>"+
					   "Jumlah Pelayanan :<?=$row->jml_pelayanan?><br>"+
					   "Email:<?=$row->email?><br>"+
					   "No Telepon :<?=$row->no_tlp?><br>"+
                       "<button class='btn btn-info' onclick='return keSini(<?=$row->lat?>,<?=$row->lng?>)'>Ke Sini</button>").openPopup());
			
					   markers.addLayer(markers);
			<?php
			}
			?>
			
            map.addLayer(markers);
            
             var control = L.Routing.control({
	    waypoints: [
	        latLng],
			lineOptions: {
			styles: [{
				color: 'green',
				opacity: 2,
				weight: 6
			}]
		},
	    geocoder: L.Control.Geocoder.nominatim(),
		routeWhileDragging: true,
		reverseWaypoints: true,
		showAlternatives: true,
		altLineOptions: {
			styles: [
				{color: 'black', opacity: 0.15, weight: 9},
				{color: 'white', opacity: 0.8, weight: 6},
				{color: 'blue', opacity: 0.5, weight: 2}
			]
		}
	}).on('routesfound',function (e){
		console.log(e.routes[0].summary)
		let jarak = e.routes[0].summary.totalDistance
		let kiloMeter = jarak / 1000
		let waktu = e.routes[0].summary.totalTime
		let menit = waktu / 60
		document.querySelector('input[name="jarak"]').value = `${kiloMeter.toFixed(1)} km`;
		document.querySelector('input[name="waktu"]').value = `${menit.toFixed(0)} min`;
		console.log(e)
	})
	control.addTo(map);


	function keSini(lat, lng) {
  var latLng = L.latLng(lat, lng);
  control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
}

$(document).on("click", ".dariSini", function () {
  let latLng = [$("[name=latNow]").val(), $("[name=lngNow]").val()];
  control.spliceWaypoints(0, 1, latLng);
  map.panTo(latLng);

  var nearestDestination;
var nearestDistance = Infinity;
var selectRs;
var selectElement = document.getElementById('namars');



  for (let i = 0; i < latitudeLongitude.length; i++) {
			let point1 = L.latLng(latLng[0], latLng[1]);
			let point2 = L.latLng(latitudeLongitude[i][0], latitudeLongitude[i][1])

			let distance = point1.distanceTo(point2);
			var distanceKm = distance / 1000;
			var distanceFixed = distanceKm.toFixed(1)

			if (distance < nearestDistance) {
    			nearestDistance = distance;
    			nearestDestination = [latitudeLongitude[i][0], latitudeLongitude[i][1]];
				selectRs=i;
  			}
			  var select = document.getElementById('namars');
			// 	// console.log(x.options[1]);
			var option = select.options[i];
			option.text = `${'     '+option.text+distanceFixed+ 'km'}`;
		}
		// console.log(nearestDestination);
		keSini(nearestDestination[0],nearestDestination[1]).openPopup();
	})
   </script>
