@extends('../layouts.base')

@section('content')

<div class="container">
            <h3 class="title form-title">CADASTRO DE MUSICAS</h3>

        <form action="/musics" method="POST" class="form">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="track">Faixa:</label>
                <input class="form-field" type="text" name="track" id="track" />
            </div>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input class="form-field" type="text" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="vocalist">Cantor:</label>
                <input class="form-field" type="text" name="vocalist" id="vocalist" />
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">

                <label class="custom-file-label" for="file">Escolha um arquivo de áudio</label>
                <input class="custom-file-input" type="file" name="file" id="file" />
            </div>
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">

                <label class="custom-file-label" for="imgTumbnail">Escolha um arquivo de imagem</label>
                <input class="custom-file-input" type="file" name="imgTumbnail" id="imgTumbnail" />
            </div>
            </div>

            <input class="btn-enviar" type="submit" value="Enviar">
        </form>
    </div>


@endsection