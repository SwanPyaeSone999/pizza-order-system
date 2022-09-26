<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    //
    public function list()
    {
        return view('admin.pizza.index', [
            'pizzas' => Product::with('category')->paginate(4),
        ]);
    }

    public function create()
    {
        return view('admin.pizza.create', [
            'categories' => Category::get(),
        ]);
    }

    public function show(Product $pizza)
    {
        return view('admin.pizza.details', [
            'pizza' => $pizza ,
        ]);
    }

    public function store(Request $request)
    {
        $data =  request()->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['mimes:jpg,jpeg,png', 'max:1024', 'image', 'required'],
        ]);
        if ($request->hasFile('image')) {
            $image  = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs(
                'pizzas',
                $image,
                'public'
            );
        }
        Product::create($data);
        return redirect()->route('pizza.list')->with('success', 'A Product  successfully created!');
    }

    public function edit(Product $pizza)
    {
        return view('admin.pizza.edit', [
            'pizza' =>  $pizza,
            'categories' => Category::get(),
        ]);
    }

    public function update(Request $request, Product $pizza)
    {
        $data = request()->validate([
            'name' => ['required', Rule::unique('products')->ignore($pizza->id)],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['mimes:jpg,jpeg,png', 'max:1024', 'image', 'required'],
        ]);

        if ($request->hasFile('image')) {
            if ($pizza->image) {
                Storage::delete('public/' . $pizza->image);
            }
            $image =  uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs(
                'pizzas',
                $image,
                'public'
            );
        }
        $pizza->update($data);
        return redirect()->route('pizza.list')->with('success', 'A Product  successfully edited!');
    }

    public function delete(Product $pizza)
    {
        if ($pizza->image) {
            Storage::delete('public/' . $pizza->image);
        }
        $pizza->delete();
        return redirect()->route('pizza.list')->with('success', 'A Product  successfully deleted!');
    }
}