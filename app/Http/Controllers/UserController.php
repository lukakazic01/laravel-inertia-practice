<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $searchValue = request('search');
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when($searchValue, function ($query, $searchValue) {
                    $query
                        ->where('name', 'like', "%{$searchValue}%")
                        ->orWhere('email', 'like', "%{$searchValue}%")
                        ->orWhere('id', 'like', "%{$searchValue}%");
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'can' => [
                        'edit' => auth()->user()->can('edit', $user),
                    ]
                ]),
            'filters' => [
                'search' => $searchValue ?? '',
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create($attrs);

        return redirect('/users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'email' => $user->email,
            'name' => $user->name,
            'id' => $user->id
        ]);
    }

    public function update(User $user, Request $request)
    {
        $attrs = $request->validate(
            [
                'name' => 'required|alpha',
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]
        );
        $user->update($attrs);
        return redirect('/users')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')->with('success', 'User deleted.');
    }
}
