<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserUpdateRequest;
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
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'address' => 'required|string',
        'phone' => 'required|string|max:15',
        'gender' => 'required|in:male,female,other',
        'status' => 'boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'roles' => 'nullable|array'
    ]);

    $data['status'] = $request->has('status') ? 1 : 0;
    $data['password'] = bcrypt($data['password']);

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('UsersImage'), $imageName);
        $data['image'] = $imageName;
    }

    $user = $this->userRepository->store($data);

    if ($request->has('roles')) {
        $user->assignRole($request->roles);
    }

    return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->show($id);
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {

        $validateData = $request->validated();

        $validateData['status'] = $request->has('status') ? 1 : 0;

        $user = $this->userRepository->update($id, $validateData);

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
