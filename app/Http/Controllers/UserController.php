<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('Pages.Users.index', [
            'title' => 'Users',
            'users' => User::all(),
            'roles' => $roles
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $users = User::all();
        return view('Pages.users.edit', [
            'title' => 'Profile',
            'role' => Role::all(),
            'users' => $users,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'roleId' => 'required|exists:roles,id',
            'email' => 'email:dns|email:rfc|unique:users,email,'.$id,
            'username' => 'max:255|unique:users,username,'.$id,
            'password' => 'nullable|min:8|max:255|customPassword:'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::findOrFail(decrypt($id));
        $userData = $request->only(['email', 'username', 'password']);
        $userData['roleId'] = $request->roleId;

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('images/profile', $fileName, 'public');
            $userData['image'] = $filePath;
        }

        $user->update($userData);

        return response()->json(['message' => 'User has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find( decrypt($id) );
        User::destroy(decrypt($id));
        return response()->json(['message' => 'User has been deleted successfully.']);
    }
}
