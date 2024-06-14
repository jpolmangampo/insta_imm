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

    public function index(Request $request)
    {
        // if (isset($request->search_name)) {
        //     $request->validate([
        //         'search_name' => 'required|min:1'
        //     ]);
        $all_users = $this->user->where('name', 'like', '%' . $request->search_name . '%')->withTrashed()->latest()->paginate(10);
        // } else {
        //     $all_users = $this->user->withTrashed()->latest()->paginate(10);
        // }

        return view('admin.users.index')
            ->with('all_users', $all_users)
            ->with('search_name', $request->search_name);
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id)
    {
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
