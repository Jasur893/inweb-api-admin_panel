<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;

class PageController extends Controller
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
        $pages = Page::latest()->paginate(5);

        return view('page.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        Page::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
        ]);

        return redirect()->route('pages.index')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('page.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('page.edit')->with(['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
        ]);

        return redirect()->route('pages.show', ['page' => $page->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index');
    }
}
