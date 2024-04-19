<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItem = OrderItems::all();

        return response()->json($orderItem);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator_orders = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer'
        ]);
    
        if ($validator_orders->fails()) {
            return response()->json($validator_orders->errors(), 422);
        }

        $cuccli2 = [
            'product_id' => $request->input('product_id'),
            'amount' =>$request->input('amount')
        ];

        $orderItem = OrderItems::create([
            'order_id' => 1,
            'product_id' => $cuccli2['product_id'],
            'amount' => $cuccli2['amount']
        ]);

        return response()->json($orderItem, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderItem = OrderItems::find($id);

        if ($orderItem === null) {
            return response()->json(['error' => 'A Rendelt termék nem található'], 404);
        }

        return response()->json($orderItem);
    }

    public function showOrderItems($order_id)
    {
        try {
            $order_items = OrderItems::where('order_id', $order_id)->get();

            if ($order_items->isEmpty()) {
                return response()->json(['message' => 'No orders found'], 404);
            }

            return response()->json($order_items->toArray(), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $orderItem = OrderItems::findOrFail($id);

        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:0'
        ]);
    
        $orderItem->update($validatedData);
        return response()->json($orderItem, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderItem = OrderItems::findOrFail($id);

        $orderItem->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}