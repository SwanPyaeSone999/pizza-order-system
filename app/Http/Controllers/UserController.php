<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function list()
    {
        $users = User::when(request('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%',);
        })->where('role', 'user')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.users.list', [
            'users' => $users,
        ]);
    }

    public function changeRole(Request $request)
    {
        User::where('id', $request->id)->update([
            'role' => $request->role,
        ]);
        return response([
            'message' => 'role change success',
        ], 200);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' =>  $user,
        ]);
    }

    public function update(User $user,Request $request)
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
        return redirect()->route('admin.user.list');
    }

    public function delete(User $user)
    {
        $user->delete();
        return back()->with('success', 'A user  successfully deleteed');
    }
}