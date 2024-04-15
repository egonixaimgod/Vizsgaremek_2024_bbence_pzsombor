<?php

namespace App\Http\Controllers;

use App\Models\Orders;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Orders::create([
            'user_id' => Auth::id(),
            'payment_id' => $request->input('payment_id'),
            'order_date' => now(),
        ]);

        return response()->json($order, Response::HTTP_CREATED);
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
