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

        $query = User::query();

        if ($request->filled('username')) {
            $query->where('username', 'like', '%' . $request->input('username') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }

        if ($request->filled('registeredDateFrom')) {
            $query->where('created_at', '>=', $request->input('registeredDateFrom'));
        }

        if ($request->filled('registeredDateTo')) {
            $query->where('created_at', '<=', $request->input('registeredDateTo'));
        }

        if ($request->filled('status')) {
            if($request->input('status') == 'active'){
                $query->whereNull('deleted_at');
            }elseif($request->input('status') == 'inactive'){
                $query->whereNotNull('deleted_at');
            }
        }

        $all_users = $query->orderBy('username')->withTrashed()->paginate(10); 

        return view('admin.users.users_list', compact('all_users'));
       
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

    public function search(Request $request)
    {
       
        $query = $this->user->newQuery();

        if($request->filled('username')){
            $query->where('username', 'like', '%'. $request->input('username') . '%');
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('username', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

       $users = $query->orderBy('username')->withTrashed()->paginate(10);

        return view('admin.users.users_list', compact('users'));
    }
}
