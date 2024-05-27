<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function store(Request $request){
        $users = new User;
        $users->name = $request->name;  
        $users->email = $request->email;
        $users->password = md5($request->password);
        $users->is_admin = $request->role;//is_admin is fild name and role is name of form
        $users->save();
        if($users){
            return redirect()->back()->with('User Created Succesfully');
        }
            return redirect()->back()->with('User fail to Created');
    }
    public function index(){
        $users = User::paginate(5);
        return view('users.index',['users'=>$users]);
    }
    
    public function update(Request $request, $id)
{
    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->is_admin = $request->role; // Assuming 'role' is passed correctly
    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}
public function destroy($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    return redirect()->back()->with('error', 'User not found');
}


}
