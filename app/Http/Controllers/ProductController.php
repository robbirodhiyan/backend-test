<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
{
    // Validasi input dari request
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:120',
        'price' => 'required|integer',
        'quantity' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Membuat produk baru
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);
}
public function update(Request $request, $id)
{
    // Validasi input dari request
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:120',
        'price' => 'required|integer',
        'quantity' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Mencari produk berdasarkan ID
    $product = Product::find($id);

    // Memastikan produk ditemukan
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Update data produk
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    return response()->json(['message' => 'Product updated successfully', 'data' => $product], 200);
}
public function destroy($id)
{
    // Mencari produk berdasarkan ID
    $product = Product::find($id);

    // Memastikan produk ditemukan
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Soft delete produk
    $product->delete();

    return response()->json(['message' => 'Product deleted successfully'], 200);
}
public function index(Request $request)
{
    $limit = $request->input('limit', 10);
    $sortby = $request->input('sortby', 'id');
    $orderby = $request->input('orderby', 'asc');

    $products = Product::orderBy($sortby, $orderby)->paginate($limit);

    return response()->json(['data' => $products], 200);
}
public function show($id)
{
    // Mencari produk berdasarkan ID
    $product = Product::find($id);

    // Memastikan produk ditemukan
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    return response()->json(['data' => $product], 200);
}
}
