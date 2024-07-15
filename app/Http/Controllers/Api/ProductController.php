<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all(), 200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'feature' => 'string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // Perbaikan di sini
            $validatedData['image'] = $path;
        }

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $validatedData = $request->validate([
                'image' => 'sometimes|image|max:2048',
                'title' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|integer',
                'feature' => 'sometimes|required|string|max:255',
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $path;
            }

            $product->update($validatedData);

            return response()->json($product, 200);
        }

        return response()->json(['error' => 'Product not found'], 404);
    }
}
