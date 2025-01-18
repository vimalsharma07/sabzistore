<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request){
     $users=    User::all();
     return view('admin.users.index',['users'=>$users]);

    }

    public function update(Request $request)
{
    $user = User::find($request->user_id);
    if ($user) {
        $user->status = $request->status;
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully.');
    }
    return redirect()->back()->with('error', 'User not found.');
}

}
