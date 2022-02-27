<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\RecordPembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        // Data
        $title = 'Orders';
        $orders = Order::latest()->get();
        $orderStatuses = OrderStatus::orderBy('id')->get();

        if (request()->has('status')) $orders = Order::where('status_id', request()->get('status'))->get();

        // Select only certain field in the given related record
        $orders->load([
            'pembeli' => function ($query) {
                $query->select('id', 'name');
            },
            'status',
            'products' => function ($query) {
                $query->select('id', 'title', 'harga');
            }
        ]);

        return view('orders.index', compact('title', 'orders', 'orderStatuses'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns',
            'phone' => 'required|numeric',
            'alamat' => 'required',
            'payment_method_id' => 'required',
            'products' => 'required'
        ]);

        if (!$validation->passes()) return response()->json([
            'error' => $validation->errors()->toArray(),
        ]);
        else {
            $pembeli = RecordPembeli::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'alamat' => $request->alamat
            ]);

            $order = new Order;
            $order->pembeli()->associate($pembeli);
            $order->paymentMethod()->associate(PaymentMethod::findOrFail($request->payment_method_id));
            $order->save();
            $order->products()->attach(json_decode($request->products));

            return response()->json([
                'status' => 1
            ]);
        }
    }

    public function show(Order $order)
    {
        // Data
        $title = 'Detail Order';
        return view('orders.show', compact('order', 'title'));
    }

    public function update(Order $order)
    {
        $order->status()->dissociate();
        $order->status()->associate(OrderStatus::findOrFail(OrderStatus::SENT));
        $order->save();
        return back()->with('success', 'Terkirim!');
    }

    public function destroy(Order $order)
    {
        //
    }
}
