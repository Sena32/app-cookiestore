@extends('../layouts.base')

@section('content')


<div class="content">
            <h3 class="title form-title">CADASTRO DE PEDIDOS</h3>

        <form action="/orders" method="POST" class="form" id="form">
        {{ csrf_field() }}
        <p> Dados do Pedido:</p>

            <div class="form-group">

            <select name="status" class="form-select">
                   <option value="true" selected>Aberto</option>
                   <option value="false" >Fechado</option>
                </select>
                <select name="client" class="form-select">
                   <option value="" selected>SELECIONE UM CLIENTE</option>
                @foreach($clients as $client)
                   <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
                </select>
            </div>
            <textarea name="notes" id="notes" cols="30" rows="10" placeholder="OBSERVAÇÕES"></textarea>
            <p> Dados do Produto:</p>
            <div class="form-group">
                <input class="form-field" type="text" name="name" id="name"  placeholder="NOME"/>

                <input class="form-field" type="text" name="amount" id="amount"  placeholder="QUANTIDADE"/>

                <input class="form-field" type="text" name="price" id="price"  placeholder="PREÇO"/>

                <input class="form-field" type="text" name="value" id="value"  placeholder="TOTAL"/>


            </div>


         <input class="btn-enviar" type="submit" value="Enviar" id="btn-send">


         </form>

    </div>

    <!-- <script>
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


	// L.circle([51.508, -0.11], 500, {
	// 	color: 'red',
	// 	fillColor: '#f03',
	// 	fillOpacity: 0.5
	// }).addTo(mymap).bindPopup("I am a circle.");

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


//   let url = `/clients`
//     let xhr = new XMLHttpRequest();
//     xhr.open('POST', url, true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4) {
//             if (xhr.status = 200)
//                 {
//                     _token: "{{ csrf_token() }}",name,telephone,street,number,neighborhood,
//                     lat,long
//                 }


//         }
//     }
//     xhr.send();

    axios.post('/clients', {name,telephone,street,number,neighborhood,lat,long})
                .then(res => {
                    alert('Cadastro Realizado com Sucesso')
                }).catch(err => {
                console.log(err)
            });
}


);



</script> -->



@endsection
