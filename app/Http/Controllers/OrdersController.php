<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderItems;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Orders::all();

        return response()->json($order);
    }

    public function placeOrder(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            // orders
            'azonosito' => 'required|integer|min:1000|max:9999|unique:orders,azonosito',
            'payment_id' => 'required|exists:payments,id',
            // order_items
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.amount' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $data = [
                'azonosito' => $request->input('azonosito'),
                'payment_id' => $request->input('payment_id'),
                'order_date' => now(),
            ];

            // Create the order
            $order = Orders::create([
                'user_id' => Auth::id(),
                'azonosito' => $data['azonosito'],
                'payment_id' => $data['payment_id'],
                'order_date' => $data['order_date']
            ]);

            $orderItems = [];
            foreach ($request->input('items') as $item) {
                $orderItems[] = [
                    'order_id' => Orders::where('azonosito', $request->input('azonosito'))->first()->id,
                    'product_id' => $item['product_id'],
                    'amount' => $item['amount'],
                ];
            }

            OrderItems::insert($orderItems);

            return response()->json($order, Response::HTTP_CREATED);
        }
    }

    public function showOrders($perPage = 10)
    {
        try {
            $user_id = Auth::id();

            $orders = Orders::where('user_id', $user_id)->with('orderItems')->paginate($perPage);

            if ($orders->isEmpty()) {
                return response()->json(['message' => 'No orders found'], 404);
            }

            return response()->json($orders->toArray(), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateOrder(Request $request, $order_id)
    {
        $validator = Validator::make($request->all(), [
            // Limit validation to updatable fields
            'payment_id' => 'nullable|exists:payments,id', // Allow optional update
            'items' => 'nullable|array', // Allow optional update
            'items.*.product_id' => 'required_if:items,.*|exists:products,id', // Required if items array exists
            'items.*.amount' => 'required_if:items,.*|integer', // Required if items array exists
        ]);
    
        $order = Orders::findOrFail($order_id);
    
        if ($request->has('payment_id')) {
            $order->payment_id = $request->input('payment_id');
        }
    
        // Process order items if provided
        if ($request->has('items')) {
            $orderItems = $order->orderItems;

            $order->orderItems()->delete();
    
            $updatedItems = [];
            foreach ($request->input('items') as $item) {
                $updatedItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'amount' => $item['amount'],
                ];
            }
    
            $order->orderItems()->createMany($updatedItems);
        }
    
        $order->save();
    
        return response()->json($order, Response::HTTP_CREATED);
    }

    public function deleteOrder($id)
    {
        $order = Orders::findOrFail($id);

        $order->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
