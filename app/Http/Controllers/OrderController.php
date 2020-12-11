<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Order;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use League\Csv\Writer;
use League\Csv\CharsetConverter;
use League\Csv\Reader;
use PhpParser\Node\Stmt\Echo_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
        ->join('clients', 'orders.client_id', '=', 'clients.id')
        ->select('orders.*', 'clients.*')
        ->paginate(2);
        // $orders = Order::all();
        // $orders = DB::select('select status,notes,value,product_name,product_price,product_amount,name,telephone,street,number,neighborhood,ST_AsGeoJSON(location) from orders join clients
        // ON orders.client_id = clients.id');
        // dd($orders);
        return view('orders.list',['orders' => $orders]);
    }

    public function export()
    {
        $orders = Order::all();
        $ver = 1;

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['id','cliente','status','notes','value','product_name','product_price','product_amount']);
        foreach($orders as $order){
        $csv->insertOne($order->toArray());
        }



        if($ver){
        $csv->output('users'.time().'.csv');
        $ver =0;
        }

        if($ver = 0) return redirect ('orders');

    }

    public function filter(Request $request)
    {
        // $orders = Order::all();


        $orders = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->select('orders.*', 'clients.*')
            ->get();
        // $orders = DB::select('select status,notes,value,product_name,product_price,product_amount,name,telephone,street,number,neighborhood,ST_AsGeoJSON(location) from orders join clients
        // ON orders.client_id = clients.id');
        dd($orders);
        // return view('orders.list',['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $clients = Client::all();
        return view('orders.create',['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->client_id        = $request->client;
        $order->status           = $request->status;
        $order->notes         = $request->notes;
        $order->value         = $request->value;
        $order->product_name   = $request->name;
        $order->product_price       = $request->price;
        $order->product_amount       = $request->amount;

        $order->save();
        return redirect('orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filterMain()
    {
        // $orders = Order::all();
        $orders = DB::select("SELECT row_to_json(fc) FROM (
            SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features FROM (
                SELECT 'Feature' As type, ST_AsGeoJSON(clients.location)::json AS geometry, row_to_json((orders.id, clients.name, clients.street, clients.number, clients.neighborhood)) AS properties FROM orders join clients
                ON orders.client_id = clients.id  WHERE orders.created_at > CURRENT_DATE-180
            ) As f
        ) As fc");
        // dd($orders);
        return response()->json($orders[0]->row_to_json );
    }

    public function main()
    {

        return view('index');
    }




}
