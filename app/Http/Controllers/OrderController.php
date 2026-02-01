<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sneaker;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('sneaker')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, Sneaker $sneaker)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $order = Order::create([
            'user_id' => $request->user()->id,
            'sneaker_id' => $sneaker->id,
            'quantity' => $data['quantity'],
            'total_price' => $sneaker->price * $data['quantity'],
            'status' => 'placed',
        ]);

        return redirect()
            ->route('orders.index')
            ->with('status', 'Order placed for '.$order->sneaker->brand.' '.$order->sneaker->model.'.');
    }

    public function destroy(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('status', 'Order cancelled.');
    }
}

