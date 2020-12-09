@extends('../layouts.base')

@section('content')
<div class="content">
    <!-- Current Tasks -->
    @if (count($orders) > 0)
        <div class="panel panel-default bg-white">
            <P class="form-title title">
                PEDIDOS
            </P>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Status</th>
                        <th>Observações</th>
                        <th>Valor</th>
                        <th></th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($orders as $order)
                            {{$order}}
                            <tr>
                                <td class="table-text">
                                <div>{{ $order->status?"Aberto":"Fechado" }}</div>

                                </td>

                                <td>
                                    <div>{{ $order->notes }}</div>
                                </td>

                                <td>
                                <div>{{ $order->value }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    </div>


@endsection
