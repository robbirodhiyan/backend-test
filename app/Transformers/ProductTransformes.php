<php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Product;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'created_at' => $product->created_at->toIso8601String(), // Contoh format waktu ISO 8601
            'updated_at' => $product->updated_at->toIso8601String(),
            'deleted_at' => $product->deleted_at,
            // tambahkan properti lain sesuai kebutuhan
        ];
    }
}
