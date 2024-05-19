<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        return CategoryResource::collection(Category::paginate(5))
            ->response()
            ->getData(true);
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

        return response()->json([
            'success' => 'created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
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

        return response()->json([
            'success' => 'updated successfully!'
        ]);
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

        return response()->json([
            'success' => 'deleted successfully!'
        ]);
    }
}
