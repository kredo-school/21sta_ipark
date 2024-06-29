<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function usersList(Request $request)
    {
       $all_users = $this->user->orderBy('username')->withTrashed()->paginate(10);

        return view('admin.users.users_list')->with('all_users', $all_users);
    }

    public function deactivate(Request $request)
    {
        $selectedIds = $request->input('user_ids', []);
        User::whereIn('id', $selectedIds)->delete();
        return redirect()->back()->with('success', 'Selected user are deleted');
    }

    public function activate(Request $request)
    {
        $selectedIds = $request->input('user_ids', []);
        
        foreach($selectedIds as $id){
            $this->user->onlyTrashed()->findOrFail($id)->restore();
        }

        return redirect()->back();
    }

}
