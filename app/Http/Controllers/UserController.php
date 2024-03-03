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
        $user = User::findOrFail(decrypt($id));
        $request->validate([
            'email' => 'required|email:dns|email:rfc|unique:users,email,'.$user->id,
            'username' => 'required|max:255|unique:users,username,'.$user->id,
            'password' => 'nullable|min:8|max:255|customPassword:'.$user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
    
        $userData = $request->only(['email', 'username', 'password']);

        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/profile', $imageName);
            if ($user->image) {
                Storage::delete($user->image);
            }
            $userData['image'] = $imagePath;
        }

        $user->update($userData);
    
        return response()->json(['message' => 'User profile has been updated successfully.']);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail(decrypt($id));

        $request->validate([
            'roleId' => 'required|exists:roles,id',
        ]);

        $user->update(['roleId' => $request->roleId]);

        return response()->json(['message' => 'User role has been updated successfully.']);
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
