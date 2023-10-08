<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
  public function index() {
    $products = Product::all();
    return view('products.index', compact('products'));
  }

  public function all() {
    return Product::all();
  }

  public function store(Request $request) {
    $rules = [
      'name' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric|min:0',
      'stock' => 'required|integer|min:0',
      // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $messages = [
      'required' => 'El campo :attribute es obligatorio.',
      'string' => 'El campo :attribute debe ser una cadena de texto.',
      'max' => [
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
      ],
      'numeric' => 'El campo :attribute debe ser un número.',
      'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
      ],
      'image' => 'El campo :attribute debe ser una imagen válida.',
      'mimes' => 'El campo :attribute debe ser una imagen de tipo :values.',
      'max' => [
        'file' => 'El campo :attribute no debe ser mayor de :max kilobytes.',
      ],
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $product = new Product([
      'name' => $request->input('name'),
      'description' => $request->input('description'),
      'price' => $request->input('price'),
      'stock' => $request->input('stock'),
      // 'image' => $request->file('image')->store('images'),
    ]);

    $product->save();
    return response()->json($product, 201);
  }

  public function show(Product $product) {
    return $product;
  }

  public function update(Request $request, $id) {
    $rules = [
      'name' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric|min:0',
      'stock' => 'required|integer|min:0',
      // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $messages = [
      'required' => 'El campo :attribute es obligatorio.',
      'string' => 'El campo :attribute debe ser una cadena de texto.',
      'max' => [
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
      ],
      'numeric' => 'El campo :attribute debe ser un número.',
      'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
      ],
      'image' => 'El campo :attribute debe ser una imagen válida.',
      'mimes' => 'El campo :attribute debe ser una imagen de tipo :values.',
      'max' => [
        'file' => 'El campo :attribute no debe ser mayor de :max kilobytes.',
      ],
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $product = Product::find($id);

    if (!$product) {
      return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->stock = $request->input('stock');

    if ($request->hasFile('image')) {
      $newImage = $request->file('image')->store('images');
      if ($product->image) {
        Storage::delete($product->image);
      }
      $product->image = $newImage;
    }
    $product->save();

    return response()->json($product, 200);
  }

  public function destroy(Product $product) {
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully'], 200);
  }
}