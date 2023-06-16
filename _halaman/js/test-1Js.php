<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
   <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>
 <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
 <script src="assets\js\leaflet-knn-master\leaflet-knn.js"></script>
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.css" />
 <link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />
 <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

 <script src="assets/js/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

   <script type="text/javascript">
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
    ?>
   <?php
	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
    $getdata=$db->ObjectBuilder()->get('rs a');	
	$jsonPoint=array();
	foreach ($getdata as $row) {
		$saveJson=null;
		$saveJson['type']="Feature";
		$saveJson['properties']=[
                                    "name"=>$row->nm_rs,
                                    "Nama Rumah Sakit"=>$row->nm_rs,
									"Alamat"=>$row->alamat.' Kec. '.$row->nm_kecamatan,
									"tipe"=>$row->tipe,
									"Jenis Rumah Sakit"=>$row->jn_rs,
                                    "popUp"=>"Nama Rumah Sakit :".$row->nm_rs."<br>Alamat :".$row->alamat.",Kec. ".$row->nm_kecamatan."<br>tipe :".$row->tipe."<br>Jenis Rumah Sakit :".$row->jn_rs
                                ];
                                    $saveJson['geometry']=[
                                                                "type" => "Point",
                                                                "coordinates" => [$row->lng,$row->lat ] 
                                                                ];	
                            
                                    $jsonPoint[]=$saveJson;
                                }
                            
                                ?>
                            
                                var geojsonPoint = <?=json_encode($jsonPoint, JSON_PRETTY_PRINT)?>;
                            


    let latLng=[-7.433099, 112.712702];
   	var map = L.map('mapid').setView(latLng, 12);

   	var LayerKita= L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    });
	map.addLayer(LayerKita);
	
	getLocation();
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
	}

    
	

    

    var geojsonPoint=L.geoJSON(geojsonPoint , {
    pointToLayer: function (feature, latlng){
        return L.marker(latlng
        );
    } ,
   	onEachFeature: function(feature,layer){
        let coord=feature.geometry.coordinates;
    		console.log(coord);
			if (feature.properties && feature.properties.name) {
		        layer.bindPopup(feature.properties.popUp+
		        	"<br><button class='btn btn-info keSini' data-lat='"+coord[1]+"' data-lng='"+coord[0]+"'>Ke Sini</button>"
					)
				}
			
    	
		    }
    	}
	).addTo(map);

	geojsonPointIndex = leafletKnn(geojsonPoint);
			map.on('click',function(ev){
				var nearestResult =geojsonPointIndex.nearest(ev.latLng,1)[0];
				nearestResult.layer.bindPopup(feature.properties.popUp+
		        	"<br><button class='btn btn-info keSini' data-lat='"+coord[1]+"' data-lng='"+coord[0]+"'>Ke Sini</button>"
					).openPopup();
			});
			
var control = L.Routing.control({
	    waypoints: [
	        latLng],
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
	})
	control.addTo(map);



	$(document).on("click",".keSini",function(){
		let latLng=[$(this).data('lat'),$(this).data('lng')];
        control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
	})



	$(document).on("click",".dariSini",function(){
		let latLng=[$("[name=latNow]").val(),$("[name=lngNow]").val()];
        control.spliceWaypoints(0, 1, latLng);
        map.panTo(latLng);
	})

			 

   </script>
