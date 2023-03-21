<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::mainCategory()->paginate(8);
        $categories = CategoryResource::collection($categories);

        $querySubCategories = Category::query();

        if ($querySubCategories)
            $querySubCategories->parentName($request->input('category'));

        $sub_categories = $querySubCategories->paginate(8);
        $sub_categories = CategoryResource::collection($sub_categories);


        $queryItem = Item::query();
        if ($request->input('category')) {
            $name = $request->input('category');
            $queryItem->filterCategoryByName($name);
        }
        $queryItem->with('category');
        $items = $queryItem->paginate(8);
        $items = ItemResource::collection($items);

        $canLogin = Route::has('login');
        $canRegister = Route::has('register');

        return Inertia::render('Welcome', compact('categories', 'sub_categories', 'items', 'canRegister', 'canLogin'));
    }
}
