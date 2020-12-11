@extends('../layouts.base')

@section('content')
<div class="content">
    <!-- Current Tasks -->
        <div class="panel panel-default bg-white">
            <P class="form-title title">
                CLIENTES
            </P>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Localização</th>
                    </thead>

                    <!-- Table Body -->

                    <tbody>

                        @foreach ($clients as $client)

                            <tr>
                                <td class="table-text">
                                <div>{{ $client->name }}</div>

                                </td>

                                <td>
                                    <div>{{ $client->telephone }}</div>
                                </td>

                                <td>
                                    <div>{{ $client->street }},{{ $client->number }}-{{ $client->neighborhood }}</div>
                                </td>

                                <td>
                                <div>{{ $client->location }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($clients) == 0)
                        <p style="text-align: center;">Nenhum registro Encontrado</p>
                    @endif
            </div>
        </div>

    </div>


@endsection
