<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create')->with([
            'categories' => Category::all()
        ]);
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

        return redirect()->route('products.index')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit')->with([
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
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

        return redirect()->route('products.show', ['product' => $product->id]);
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

        return redirect()->route('products.index');
    }
}
