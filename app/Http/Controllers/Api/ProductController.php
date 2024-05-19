<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(5))
            ->response()
            ->getData(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('product', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'photo' => $path ?? ""
        ]);

        return response()->json([
            'success' => 'created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('photo')) {
            if(isset($product->photo)){
                Storage::disk('public')->delete($product->photo);
            }

            $path = $request->file('photo')->store('product', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'photo' => $path ?? $product->photo
        ]);

        return response()->json([
            'success' => 'updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if(isset($product->photo)){
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return response()->json([
            'success' => 'deleted successfully!'
        ]);
    }
}
