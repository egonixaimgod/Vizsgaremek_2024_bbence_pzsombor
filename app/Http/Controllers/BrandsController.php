<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandsRequest;
use App\Http\Requests\UpdateBrandsRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brands::all();

        return response()->json($brands);
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
    public function store(StoreBrandsRequest $request)
    {
        $brand = Brands::create($request->all());
        return response()->json($brand, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brands $brands)
    {
        return response()->json($brands);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brands)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandsRequest $request, Brands $brands)
    {
        $brands->update($request->all());
        return response()->json($brands, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brands)
    {
        $brands->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}