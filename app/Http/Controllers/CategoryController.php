<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // category list
    public function list()
    {
        // dd(request('search'));
        $categories =  Category::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%' );
        })
        ->orderBy('id','desc')
        ->paginate(4    );

        return view('admin.category.list', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'unique:categories,name','min:4'],
        ]);
        Category::create($data);
        return redirect()->route('category.list')->with('success', 'A Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' =>  $category,
        ]);
    }

    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => ['required','unique:categories,name,'.$category->id],
        ]);
        $category->update($data);
        return redirect()->route('category.list')->with('success', 'A Category Edited Successfully');
    }

    public function delete(Category $category)
    {
            $category->delete();
            return redirect()->route('category.list')->with('success', 'A Category Deleted Successfully');

   }
}
