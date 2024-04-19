<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Brands;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::all();

        return response()->json($product);
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
        $product = Products::create($request->all());
        return response()->json($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::find($id);

        if ($product === null) {
            return response()->json(['error' => 'A Termék nem található'], 404);
        }

        return response()->json($product);
    }

    //nem működik
    public function productsByBrand(Request $request, $brand_id)
    {
        $product=Products::where('brand_id',$brand_id)->get();

        if ($product === null) {
            return response()->json(['error' => 'Ilyen márkával rendelkező termék nem található'], 404);
        }

        return response()->json($product);
    }

    //nem működik
    public function productsByCategory(Request $request, $category_id)
    {
        $product=Products::where('category_id',$category_id)->get();

        if ($product === null) {
            return response()->json(['error' => 'Ilyen kategóriával rendelkező termék nem található'], 404);
        }

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string',
            'cost' => 'required|integer|min:0',
            'img' => 'required|string',
            'amount' => 'required|integer|min:0'
        ]);
        
        $product->update($request->all());
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        $product->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}