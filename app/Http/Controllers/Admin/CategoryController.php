<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $categories = Category::latest()->paginate(5);

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('category', 'public');
        }

        Category::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'photo' => $path ?? ""
        ]);

        return redirect()->route('categories.index')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->hasFile('photo')) {
            if(isset($category->photo)){
                Storage::disk('public')->delete($category->photo);
            }

            $path = $request->file('photo')->store('category', 'public');
        }

        $category->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'photo' => $path ?? $category->photo
        ]);

        return redirect()->route('categories.show', ['category' => $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(isset($category->photo)){
            Storage::disk('public')->delete($category->photo);
        }

        $category->delete();

        return redirect()->route('categories.index');
    }
}
