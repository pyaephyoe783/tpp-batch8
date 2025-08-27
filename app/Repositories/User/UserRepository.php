<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete($id);
        return $user;
    }


    public function update($id, $data)
    {
        $user = User::find($id);
        $user->update($data);

        return $user;
    }
}
