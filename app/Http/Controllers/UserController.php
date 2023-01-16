<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function add()
    {
        $roles = User::getRoles();
        return view('users.add', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request['password']);

        User::query()->firstOrCreate($data);

        return redirect()->route('users.index')->with('success', 'Successfully added!');

    }

    public function edit(User $user)
    {
        $roles = User::getRoles();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        User::query()->where('id', $user->id)->update($data);

        return redirect()->route('users.index')->with('success', 'Successfully edited!');
    }

    public function status(Request $request)
    {
        $data = [
            'status' => $request->status,
        ];

        User::query()
            ->where('id', $request->id)
            ->update($data);

        return response('success', 200);
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function delete($id)
    {

        User::destroy($id);

        return redirect()->route('users.index');
    }
}
