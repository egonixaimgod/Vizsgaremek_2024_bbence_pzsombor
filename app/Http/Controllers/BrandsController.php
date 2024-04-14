<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
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
    public function store(Request $request)
    {
        $brand = Brands::create($request->all());
        return response()->json($brand, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brands::find($id);

        if ($brand === null) {
            return response()->json(['error' => 'Márka nem található'], 404);
        }

        return response()->json($brand);
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
    public function update(Request $request, $id)
    {
        $brands = Brands::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('brands')->ignore($brands->id),
            ],
        ]);
        
        $brands->update($request->all());
        return response()->json($brands, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands = Brands::findOrFail($id);

        $brands->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}