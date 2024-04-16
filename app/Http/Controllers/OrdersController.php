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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function placeOrder(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            // Orders
            'azonosito' => 'required|integer|min:1000|max:9999|unique:orders,azonosito',
            'payment_id' => 'required|exists:payments,id',
            // Order items (array)
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

            // Create order items in a single transaction
            OrderItems::insert($orderItems);

            return response()->json($order, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::find($id);

        if ($order === null) {
            return response()->json(['error' => 'A Rendelés nem található'], 404);
        }

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Orders::findOrFail($id);

        $validatedData = $request->validate([
            'azonosito' => 'required|integer|min:1000|max:9999',
            'user_id' => 'required|exists:users,id',
            'payment_id' => 'required|exists:payments,id',
            'date_time' => 'required|date'
        ]);
    
        $order->update($validatedData);
        return response()->json($order, Response::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        $order->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
