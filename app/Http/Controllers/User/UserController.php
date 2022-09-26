<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //home route
    public function home()
    {
        $pizzas =  Product::orderBy('created_at', 'desc')->get();
        $cart =  Cart::where('user_id', auth()->user()->id)->get();
        return view('users.home', compact('pizzas', 'cart'));
    }

    public function changePassword()
    {
        return view('users.password.change');
    }

    public function passwordUpdate()
    {
        $data = request()->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'min:6', 'same:new_password'],
        ]);
        if (Hash::check(request('old_password'), auth()->user()->password)) {
            $new_password = Hash::make(request()->new_password);
            User::where('id', auth()->user()->id)->update([
                'password' => $new_password,
            ]);
            //  Auth::logout();
            return back()->with('success','Password Update Successfully!');
        }
        return back()->withInput()
            ->withErrors(['old_password' => 'Old password does not match!']);
    }

    public function edit(User $user)
    {
        $user  = auth()->user();
        return view('users.profile.account', compact('user'));
    }

    public function save(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024', 'image'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string',],
        ]);
        if ($request->hasFile('image')) {
            if (auth()->user()->image) {
                Storage::delete('public/' . auth()->user()->image);
            }
            $image =  uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs(
                'images',
                $image,
                'public'
            );
        }
        $user->update($data);
        return back();
    }

    public function filter(Category $category)
    {
        return view('users.home', [
            'pizzas' => $category->products,
            'cart' => Cart::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function show(Product $product)
    {
        return view('users.details', [
            'pizza' => $product,
        ]);
    }

    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('users.cart', compact('cartList'));
    }

    public function history()
    {
        return view('users.history', [
            'orders' => Order::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->paginate(5),
        ]);
    }

    public function contact()
    {
        return view('users.contact');
    }

    public function storeContact()
    {
        $data  = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        Contact::create($data);
        return back()->with('sent','Message has been sent');
    }
}