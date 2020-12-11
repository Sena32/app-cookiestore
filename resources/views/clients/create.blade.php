@extends('../layouts.base')

@section('content')


<div class="content">
            <h3 class="title form-title">CADASTRO DE CLIENTES</h3>

        <form action="/clients" method="POST" class="form" id="form">
        {{ csrf_field() }}
        <p> Dados de Pessoais:</p>
            <div class="form-group">
                <input class="form-field" type="text" name="name" id="name" placeholder="NOME"/>
                <input class="form-field" type="telephone" name="telephone" id="telephone" placeholder="TELEFONE"/>
            </div>
            <p> Dados de Endereço:</p>
            <div class="form-group">
                <input class="form-field" type="text" name="street" id="street" disabled placeholder="RUA"/>

                <input class="form-field" type="text" name="number" id="number" disabled placeholder="NUMERO"/>

                <input class="form-field" type="text" name="neighborhood" id="neighborhood" disabled placeholder="BAIRRO"/>


            </div>
            <p>Selecione o Endereço no Mapa:</p>



         </form>



        <div id="mapid" ></div>

        <input class="btn-enviar" type="button" value="Enviar" id="btn-send">

    </div>
    <script src="{{ url(mix('js/mapInsert.js')) }}" defer></script>


@endsection
