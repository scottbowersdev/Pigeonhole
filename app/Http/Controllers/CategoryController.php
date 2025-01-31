<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        return view('category.index', [
            'categories' => Category::where('user_id', Auth::id())->orderBy('name', 'asc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'color' => ['required']
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => request('name'),
            'color' => request('color'),
        ]);
        return redirect('/categories')->withSuccess('Your category has been added successfully.');
    }

    public function show() {}

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        // Validate
        request()->validate([
            'name' => ['required'],
            'color' => ['required']
        ]);

        // Update
        $category->update([
            'name' => request('name'),
            'color' => request('color'),
        ]);

        // Redirect
        return redirect('/categories')->withSuccess('Your category has been updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Authorise

        // Delete
        $category->delete();

        // Redirect
        return redirect('/categories')->withSuccess('Your category has been deleted successfully.');
    }

    public function delete(Category $category)
    {
        // Authoris

        // Delete
        $category->delete();

        // Redirect
        return redirect('/categories')->withSuccess('Your category has been deleted successfully.');
    }

}
