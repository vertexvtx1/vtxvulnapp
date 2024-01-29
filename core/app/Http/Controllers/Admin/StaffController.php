<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function index()
    {
        $pageTitle = 'All Staff';
        $allStaff  = Admin::where('id','!=',1)->with('role')->searchable(['username'])->paginate(getPaginate());
        $roles     = Role::all();
        return view('admin.staff.index', compact('pageTitle', 'allStaff', 'roles'));
    }

    public function status($id)
    {
        return Admin::changeStatus($id);
    }

    public function save(Request $request, $id = 0)
    {

        $this->validation($request, $id);

        if ($id) {
            $staff   = Admin::whereNot('id', 1)->findOrFail($id);
            $message = "Staff updated successfully";
        } else {
            $staff   = new Admin();
            $message = "New staff added successfully";
        }

        $staff->name        = $request->name;
        $staff->username    = $request->username;
        $staff->email       = $request->email;
        $staff->role_id     = $request->role_id;
        $staff->password    = $request->password ? Hash::make($request->password) : $staff->password;
        $staff->save();
        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    private function validation($request, $id)
    {
        $request->validate([
            'username'    => 'required|unique:admins,username,' . $id,
            'name'        => 'required',
            'email'       => 'required|unique:admins,email,' . $id,
            'role_id'     => 'required|integer|gt:0',
            'password'    => !$id ? 'required|min:6' : 'nullable',
        ]);
    }

    public function login($id)
    {
        Auth::guard('admin')->loginUsingId($id);
        return to_route('admin.dashboard');
    }
}
