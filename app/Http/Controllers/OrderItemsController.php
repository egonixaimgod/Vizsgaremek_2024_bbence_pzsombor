<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderItem = OrderItems::create($request->all());
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItems $orderItems)
    {
        //
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