@extends('../layouts.base')

@section('content')


<div class="content">
            <h3 class="title form-title">CADASTRO DE CLIENTES</h3>

        <form action="/clients" method="POST" class="form" id="form">
        {{ csrf_field() }}
        <p> Dados de Pessoais:</p>
            <div class="form-group">
                <input class="form-field" type="text" name="name" id="name" placeholder="NOME"/>
                <input class="form-field" type="text" name="telephone" id="telephone" placeholder="TELEFONE"/>
            </div>
            <p> Dados de Endereço:</p>
            <div class="form-group">
                <input class="form-field" type="text" name="street" id="street" disabled placeholder="RUA"/>

                <input class="form-field" type="text" name="number" id="number" disabled placeholder="NUMERO"/>

                <input class="form-field" type="text" name="neighborhood" id="neighborhood" disabled placeholder="BAIRRO"/>


            </div>
            <p>Selecione o Endereço no Mapa:</p>



         </form>



        <div id="mapid" style="height: 400px; margin-bottom:20px;"></div>

        <input class="btn-enviar" type="button" value="Enviar" id="btn-send">

    </div>

    <script>
	var mymap = L.map('mapid');
    let layerPrev = '';
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


    const setMarker = (json)=>{

        const {lat, lng} = json;
        const layer = L.marker(!(lat && lng)?[json.results[0].geometry.location.lat, json.results[0].geometry.location.lng]:[lat, lng]).addTo(mymap)
        .bindPopup(lat && lng ? "Sua localização atual":json.results[0].formatted_address).openPopup();
        layerPrev = layer;
    }


	L.polygon([
		[51.509, -0.08],
		[51.503, -0.06],
		[51.51, -0.047]
	]).addTo(mymap).bindPopup("I am a polygon.");


	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
            getAddress(e.latlng);
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

function setFields(json) {
    document.querySelector('input[name=street]').value = json.results[0].address_components[1].long_name;
    document.querySelector('input[name=number]').value = json.results[0].address_components[0].long_name;
    document.querySelector('input[name=neighborhood]').value = json.results[0].address_components[2].long_name;
}


    mymap.on('click', onMapClick);

const form = document.querySelector('#form');
const btn_send = document.querySelector('#btn-send');
const field_name = document.querySelector('#name');
const field_telephone = document.querySelector('#telephone');
const field_street = document.querySelector('#street');
const field_number = document.querySelector('#number');
const field_neighborhood = document.querySelector('#neighborhood');



form.addEventListener("submit", function(e) {
  e.preventDefault();
});

btn_send.addEventListener("click", function() {
    let name = field_name.value;
    let telephone = field_telephone.value;
    let street = field_street.value;
    let number = field_number.value;
    let neighborhood = field_neighborhood.value;
    let {lat, lng:long} = layerPrev._latlng;


    axios.post('/clients', {name,telephone,street,number,neighborhood,lat,long})
                .then(res => {
                    alert('Cadastro Realizado com Sucesso')
                }).catch(err => {
                console.log(err)
            });
}


);



</script>



@endsection
