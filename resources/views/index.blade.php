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
        getData();
         function getData(){
            let url = `{{route('orders.show')}}`

            axios.get(`${url}`)
            .then(function (response) {
                console.log(response.data)

                buildMap(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }

        function buildMap(data){
            var mymap = L.map('mapid').setView([-7.184243400000001, -34.8806113], 13);
            let layerPrev = '';
            // const res = data.map(d=>(
            //     d.st_asgeojson
            // ));
            const geo = data;
            console.log(geo)

            const position = navigator.geolocation.getCurrentPosition((position)=>{
                const {latitude:lat,longitude:lng} = position.coords;
                // mymap.setView([lat, lng], 13);
                // setMarker({lat,lng});
                // getAddress({lat,lng});
                console.log(lat, lng)
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

            var geojsonFeature = JSON.parse(data);//{"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"Point","coordinates":[-34.880634,-7.184354]},"properties":{"f1":1,"f2":"Aline Rodrigues Montenegro"}},{"type":"Feature","geometry":{"type":"Point","coordinates":[-34.880634,-7.184354]},"properties":{"f1":3,"f2":"Aline Rodrigues Montenegro"}}]};
            console.log(typeof(geojsonFeature))
            L.geoJson(geojsonFeature,{
            onEachFeature: function (feature, layer) {
                console.log(feature)
                layer.bindPopup(`Pedido Realizado por:
                <br/><strong>${feature.properties.f2}</strong>
                <br/>${feature.properties.f3}, ${feature.properties.f4}
                <br/><strong>${feature.properties.f5}</strong>
                `);
            }
        }).addTo(mymap);
        }

    </script>


@endsection


