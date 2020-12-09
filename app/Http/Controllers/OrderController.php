<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Order;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB as FacadesDB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Order::all();
        $orders = FacadesDB::select('select *,ST_AsGeoJSON(location) from orders join clients
        ON orders.client_id = clients.id');
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
        $orders = FacadesDB::select('select *,ST_AsGeoJSON(location) from orders join clients
        ON orders.client_id = clients.id');
        // dd($orders);
        return response()->json($data=$orders, $status=200);
    }

    public function main()
    {

        return view('index');
    }

}
