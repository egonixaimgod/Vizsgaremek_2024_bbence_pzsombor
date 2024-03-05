<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderItemsRequest;
use App\Http\Requests\UpdateOrderItemsRequest;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItems $orderItems)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItems $orderItems)
    {
        //
    }
}
