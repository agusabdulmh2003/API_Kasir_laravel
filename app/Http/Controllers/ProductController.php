<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return Product::all();
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'price' => 'required|integer',
        'stock' => 'required|integer',
    ]);

    $product = Product::create($data);
    return response()->json($product);
}

}
