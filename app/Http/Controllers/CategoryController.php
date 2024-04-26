<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('category_name')->withCount('albums')->paginate(10);
        $category = new Category();
        return view('categories.index', compact('categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('categories.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $res = Category::create([
            'category_name' => $request->category_name
        ]);

        $message = $res ? 'Category created' : 'Problem creating category';
        session()->flash('messages', $message);

        if ($request->ajax()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.create', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->category_name = $request->category_name;
        $res = $category->save();

        $message = $res ? 'Category created' : 'Problem creating category';
        session()->flash('messages', $message);

        if ($request->ajax()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {
        $res = $category->delete();

        $message = $res ? 'Category deleted' : 'Problem deleting category';
        session()->flash('messages', $message);

        if ($request->ajax()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }
}
