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

        // dd($request->all());
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



        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'address' => 'required|string',
        //     'phone' => 'required|string|max:15',
        //     'gender' => 'required|in:male,female,other',
        //     'status' => 'boolean',
        //     'roles' => 'nullable|array',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        // ]);

        // dd($request->all());

        // // if (isset($data['roles'])) {
        // //     unset($data['roles']);
        // // }

        // $data['status'] = $request->has('status') ? 1 : 0;
        // $data['password'] = Hash::make($data['password']);
        // //    $data['roles'] = implode(',',$data['roles']);

        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('UsersImage'), $imageName);
        //     $data['image'] = $imageName;
        // }

        // // if (isset($data['roles']) && is_array($data['roles'])) {
        // //     $user = $this->userRepository->store($data);
        // //     $user->syncRoles($data['roles']);
        // // } else {
        // //     $user = $this->userRepository->store($data);
        // // }

        // $user = $this->userRepository->store($data);
        // $user->syncRoles($request->roles);



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
