@extends('layouts.base')

@section('content')
<div class="content">
    <!-- Current Tasks -->
        <div class="panel panel-default bg-white">
            <P class="form-title title">
                PEDIDOS
            </P>

            <div class="panel-body">
                <div id="mapid" style="height: 400px; margin-bottom:20px;"></div>
            </div>


    </div>
    <script src="{{url(mix('js/app.js'))}}"></script>
    <script>


var mymap = L.map('mapid');
let layerPrev = '';
let data = [];


const position = navigator.geolocation.getCurrentPosition((position)=>{
    const {latitude:lat,longitude:lng} = position.coords;
    mymap.setView([lat, lng], 13);
    setMarker({lat,lng});
    getAddress({lat,lng});
});


L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
}).addTo(mymap);


function onEachFeature(feature, layer) {
		var popupContent = "<p>I started out as a GeoJSON " +
				feature.geometry.type + ", but now I'm a Leaflet vector!</p>";

		if (feature.properties && feature.properties.popupContent) {
			popupContent += feature.properties.popupContent;
		}

		layer.bindPopup(popupContent);
    }


// 	var coorsLayer = L.geoJSON(coorsField, {

// pointToLayer: function (feature, latlng) {
//     return L.marker(latlng, {icon: baseballIcon});
// },

// onEachFeature: onEachFeature
// }).addTo(map);



const setMarker = (json)=>{

    const {lat, lng} = json;
    const layer = L.marker(!(lat && lng)?[json.results[0].geometry.location.lat, json.results[0].geometry.location.lng]:[lat, lng]).addTo(mymap)
    .bindPopup(lat && lng ? "Sua localização atual":json.results[0].formatted_address).openPopup();
    layerPrev = layer;
}


async function getAddress(latlng) {

const {lat, lng}=latlng;

let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&location_type=ROOFTOP&result_type=street_address&language=cs&key=AIzaSyAO2prDBMuQLK97HIqojo2NlaAQ-s2zBBk`
let xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        if (xhr.status = 200)
            setFields(JSON.parse(xhr.responseText))
            layerPrev!==''&&layerPrev.remove(mymap);
            setMarker(JSON.parse(xhr.responseText))


    }
}
xhr.send();
}



</script>


@endsection


