<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    // public function __construct(){
    //     Gate::authorize('admin-control');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(5);

        return View("users.index",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [ 'required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:30'],
            'comfirm_password' => ['required', 'string', 'min:6', 'max:30', 'same:password'],
            'type' => [ 'required', 'in:admin,writer']
        ]);

        User::create($data);

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function posts(string $id)
    {
        $user= User::findOrFail($id);
        return view("users.posts", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return View("users.edit", ['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => [ 'required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', Rule::unique("users")->ignore($id)],
            'password' => ['nullable', 'string', 'min:6', 'max:30'],
            'comfirm_password' => ['nullable', 'string', 'min:6', 'max:30', 'same:password'],
            'type' => [ 'required', 'in:admin,writer']
        ]);

        $data['password']=$request->has('password') ? bcrypt($request->password) : $user->password;
        unset($data['comfirm_password']);

        User::where('id',$id)->update($data);

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return to_route('users.index');
    }
}
