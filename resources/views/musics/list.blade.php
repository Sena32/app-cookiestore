@extends('../layouts.base')

@section('content')

    <!-- Current Tasks -->
    @if (count($musics) > 0)
        <div class="panel panel-default bg-white">
            <div class="panel-heading">
                Musicas
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Faixa</th>
                        <th>Nome</th>
                        <th>Cantor</th>
                        <th>File</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($musics as $music)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $music->track }}</div>
                                </td>

                                <td>
                                    <div>{{ $music->name }}</div>
                                </td>

                                <td>
                                    <div>{{ $music->vocalist }}</div>
                                </td>

                                <td>
                                    <a href="{{ $music->file }}">Play</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


@endsection