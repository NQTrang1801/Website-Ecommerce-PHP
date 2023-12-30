<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\alert;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'Pending Confirmation')->paginate(10);
    
        return view('admin.orders.orders-pending', compact('orders'));
    }

    public function indexCancelled()
    {
        $orders = Order::where('status', 'Cancelled')->paginate(10);
    
        return view('admin.orders.orders-cancelled', compact('orders'));
    }

    public function indexConfirmed()
    {
        $orders = Order::where('status', 'Confirmed')->paginate(10);
    
        return view('admin.orders.orders-confirmed', compact('orders'));
    }

    public function indexTransit()
    {
        $orders = Order::where('status', 'In Transit')->paginate(10);
    
        return view('admin.orders.orders-transit', compact('orders'));
    }

    public function updateStatus($orderId, Request $request)
    {
        $order = Order::findOrFail($orderId);
        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }
        $order->status = $request->status;
        $order->save();

        return response()->json(['status' => true, 'message' => 'Status updated successfully']);
    }


}
