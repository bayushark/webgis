<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.css" />
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />
 <script src="assets/js/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

   <script type="text/javascript">

   	var map = L.map('mapid').setView([-7.433099, 112.712702], 10);

   	var LayerKita= L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
    //    accessToken: 'your.mapbox.access.token'
});
	map.addLayer(LayerKita);

	var myStyle2 = {
	    "color": "#ffff00",
	    "weight": 1,
	    "opacity": 0.9
	};

	function popUp(f,l){
	    var out = [];
	    if (f.properties){
	         for(key in f.properties){
	        	out.push(key+": "+f.properties[key]);

	         }
			
	        l.bindPopup(out.join("<br />"));
	    }
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
	}

	function featureToMarker(feature, latlng) {
		return L.marker(latlng, {
			icon: L.divIcon({
				className: 'marker-'+feature.properties.amenity,
				html: iconByName(feature.properties.amenity),
				iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
		});
	}

	var baseLayers = [
		{
			name: "OpenStreetMap",
			layer: LayerKita
		}
	];

	<?php
		$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
		foreach ($getKecamatan as $row) {
			?>

			var myStyle<?=$row->id_kecamatan?> = {
			    "color": "<?=$row->warna_kecamatan?>",
			    "weight": 1,
			    "opacity": 1
			};

			<?php
			$arrayKec[]='{
			name: "'.$row->nm_kecamatan.'",
			icon: iconByName("'.$row->warna_kecamatan.'"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_kecamatan.'"],{onEachFeature:popUp,style: myStyle'.$row->id_kecamatan.',pointToLayer: featureToMarker }).addTo(map)
			}';
		}
	?>

	var overLayers = [{
		group: "Layer Kecamatan",
		layers: [
			<?=implode(',', $arrayKec);?>
		]
	}
	];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});
	
	map.addControl(panelLayers);
	

	var markers = L.markerClusterGroup();
	

<?php

if($tipe!='pilih tipe'){
	$db->where('tipe','%'. $tipe,'LIKE');
}

if($jn_rs!='pilih jenis rumah sakit'){
	$db->where('jn_rs','%'. $jn_rs,'LIKE');
}

	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
			$getdata=$db->ObjectBuilder()->get('rs a');
			
			foreach ($getdata as $row) {	
			?>
			
			 markers.addLayer ( L.marker([<?=$row->lat?>,<?=$row->lng?>])
			.bindPopup("Nama Rumah Sakit :<?=$row->nm_rs?><br>Alamat :<?=$row->alamat?>,Kec. <?=$row->nm_kecamatan?><br>Tipe :<?=$row->tipe?><br>Jenis Rumah Sakit :<?=$row->jn_rs?><br>Jumlah Pelayanan :<?=$row->jml_pelayanan?><br>Email :<?=$row->email?><br>No Telepon :<?=$row->no_tlp?> ").openPopup());
			markers.addLayer(markers);
			
			<?php
			}
			?>
			 map.addLayer(markers);
			 

   </script>
