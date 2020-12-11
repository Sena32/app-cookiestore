@extends('../layouts.base')

@section('content')
<div class="content">
    <!-- Current Tasks -->
    @if (count($orders) > 0)
    <button type="button" class="btn btn-outline-success" onclick="exportToExcel()"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-excel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
  <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
  <path fill-rule="evenodd" d="M5.18 6.616a.5.5 0 0 1 .704.064L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 0 1 .064-.704z"/>
</svg></button>
        <div class="panel panel-default bg-white">
            <P class="form-title title">
                PEDIDOS
            </P>


            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Status</th>
                        <th>Cliente</th>
                        <th>Observações</th>
                        <th>Valor</th>
                        <th>Endereço</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="table-text">
                                <div>{{ $order->status?"Aberto":"Fechado" }}</div>

                                </td>

                                <td>
                                    <div>{{ $order->name }}</div>
                                </td>

                                <td>
                                    <div>{{ $order->notes }}</div>
                                </td>

                                <td>
                                <div>{{ $order->value }}</div>
                                </td>

                                <td>
                                <div>{{ $order->street }},{{ $order->number }}-{{ $order->neighborhood }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="pagination">{{ $orders->links() }}</div>

            </div>
        </div>
    @endif

<script>
    function exportToExcel(){
        axios.get(`{{route('orders.export')}}`).then(
            function(res){
                console.log(res)
            }
        ).catch(
            function(err){
                console.log(err)
            }
        )
    }
</script>
@endsection
