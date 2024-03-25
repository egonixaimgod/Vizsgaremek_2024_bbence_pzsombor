<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderItemsRequest;
use App\Http\Requests\UpdateOrderItemsRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = OrderItems::all();

        return response()->json($orderItems);
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
    public function store(StoreOrderItemsRequest $request)
    {
        $orderItem = OrderItems::create($request->all());
        return response()->json($orderItem, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItems $orderItems)
    {
        return response()->json($orderItems);
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
    public function update(UpdateOrderItemsRequest $request, OrderItems $orderItems)
    {
        $orderItems->update($request->all());
        return response()->json($orderItems, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItems $orderItems)
    {
        $orderItems->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}