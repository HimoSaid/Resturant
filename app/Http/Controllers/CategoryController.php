<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        $query->with('parent');
        $limit = $request->input('limit', 5);
        $categories = $query->latest()->paginate($limit);

        $categories = CategoryResource::collection($categories);

        return Inertia::render('Category/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $query = Category::query();

        $search = $request->input('search');
        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }
        $limit = $request->input('limit', 10);
        $query->limit($limit);

        $categories = $query->get(['id', 'name']);
        return Inertia::render('Category/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        //store
        $data = $request->all();
        $data['user_id'] = auth()->id();

        Category::create($data);

        return Redirect(route('categories.index'))->with('message', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {
        $query = Category::query();

        $search = $request->input('search');
        $query = Category::query();
        $query->where('id', '!=', $category->id);
        if ($search) {
            $query->where('name', 'like', "%$search%");
        }
        if ($request->input('value')) {
            $query->orWhere('id', $request->input('value'));
        }
        if ($category->parent_id) {
            $query->orWhere('id', $category->parent_id);
        }
        $limit = $request->input('limit', 10);
        $query->limit($limit);

        $categories = $query->get(['id', 'name']);
        return Inertia::render('Category/Edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->all());

        return Redirect(route('categories.index'))->with('message', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect(route('categories.index'))->with('message', 'Category deleted successfully');
    }
}
