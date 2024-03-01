<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
{
    // Validasi input dari request
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Mencari produk berdasarkan ID
    $product = Product::find($request->product_id);

    // Memastikan produk ditemukan
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Harga dasar produk
    $basePrice = $product->price;

    // Menghitung pajak (10% dari harga dasar)
    $tax = 0.1 * $basePrice;

    // Menghitung biaya admin (5% dari harga dasar ditambah pajak)
    $adminFee = 0.05 * ($basePrice + $tax);

    // Menghitung total transaksi
    $total = ($basePrice + $tax + $adminFee) * $request->quantity;

    // Cek stok produk
    if ($request->quantity > $product->quantity) {
        return response()->json(['error' => 'Out of stock'], 400);
    }

    // Membuat transaksi baru
    if ($request->user()) {
        // Membuat transaksi baru dengan menyertakan 'user_id'
        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'price' => $basePrice,
            'quantity' => $request->quantity,
            'admin_fee' => $adminFee,
            'tax' => $tax,
            'total' => $total,
        ]);

    } else {
        // Handle kasus ketika pengguna tidak terautentikasi
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Mengurangi stok produk
    $product->decrement('quantity', $request->quantity);

    return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction], 201);
}
public function index(Request $request)
{
    $limit = $request->input('limit', 10);
    $sortby = $request->input('sortby', 'id');
    $orderby = $request->input('orderby', 'asc');

    $transactions = Transaction::orderBy($sortby, $orderby)->paginate($limit);

    return response()->json(['data' => $transactions,], 200);
}
public function show($id)
{
    // Mencari transaksi berdasarkan ID
    $transaction = Transaction::find($id);

    // // Memastikan transaksi ditemukan
    // if (!$transaction) {
    //     return response()->json(['error' => 'Transaction not found'], 404);
    // }

    // // Cek otorisasi hanya untuk customer atau admin yang berhubungan dengan transaksi tersebut
    // $user = Auth::user();
    // if ($user->id !== $transaction->user_id && !$user->hasRole('admin')) {
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }

    return response()->json(['data' => $transaction], 200);
}
}
