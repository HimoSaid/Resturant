<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::query();

        $query->with('category');
        $limit = $request->input('limit', 10);
        $items = $query->paginate($limit);

        $items = ItemResource::collection($items);

        return Inertia::render('Item/Index', compact('items'));
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
        if ($request->input('value')) {
            $query->orWhere('id', $request->input('value'));
        }
        $limit = $request->input('limit', 10);
        $query->limit($limit);

        $categories = $query->get(['id', 'name']);


        return Inertia::render('Item/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateItemRequest $request)
    {
        //store
        Item::create($request->all());
        return Redirect::route('items.index')->with('message', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Item $item)
    {
        $query = Category::query();

        $search = $request->input('search');
        $query = Category::query();
        if ($search) {
            $query->where('name', 'like', "%$search%");
        }
        if ($request->input('value')) {
            $query->orWhere('id', $request->input('value'));
        }
        if ($item->category_id) {
            $query->orWhere('id', $item->category_id);
        }
        $limit = $request->input('limit', 10);
        $query->limit($limit);

        $categories = $query->get(['id', 'name']);

        return Inertia::render('Item/Edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());
        return Redirect::route('items.index')->with('message', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {

        $item->delete();
        return Redirect::route('items.index')->with('message', 'Item deleted successfully');
    }
}
