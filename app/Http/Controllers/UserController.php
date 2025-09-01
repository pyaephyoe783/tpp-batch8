<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->userRepository->index();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userRepository->show($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('UsersImage'), $imageName);
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'status' => $request->status ? 1 : 0,
            'image' => $imageName,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->show($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, $id)
    {

        $validateData = $request->validated();

        $validateData['status'] = $request->has('status') ? 1 : 0;

        $user = $this->userRepository->update($id, $validateData);

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $user = $this->userRepository->delete($id);
        return redirect()->route('users.index')->with('delete success');
    }

    public function status($id)
    {
        $user = $this->userRepository->show($id);

        $userStatus = $user->status == 1 ? 0 : 1;
        $this->userRepository->update($id, ['status' => $userStatus]);
        return redirect()->route('users.index');
    }
}
