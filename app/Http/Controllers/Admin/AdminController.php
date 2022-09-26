<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function accountDetails()
    {
        return view('admin.accounts.details', [
            'user' => auth()->user(),
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.accounts.edit', [
            'user' => $user,
        ]);
    }
    public function save(User $user, Request $request)
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

    public function list()
    {
        $admins = User::when(request('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        })
            ->where('role', 'admin')
            ->orderBy('id', 'desc')
            ->paginate(3);
        $admins->appends(request()->all());
        return view('admin.admin-list.index', [
            'admins' => $admins,
        ]);
    }

    public function role(User $user)
    {
        return view('admin.admin-list.change-role', [
            'account' => $user,
        ]);
    }

    public function changeRole(User $user)
    {
        $user->update([
            'role' => request('role'),
        ]);
        return redirect()->route('admin.list');
    }

    public function delete(User $user)
    {
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }
        $user->delete();
        return back();
    }
}