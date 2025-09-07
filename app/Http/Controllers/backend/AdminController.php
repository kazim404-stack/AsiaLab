<?php

namespace App\Http\Controllers\backend;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }
    public function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function create()
    {
        return view('admin.profile.change_password');
    }
    public function chnagePassword(Request $request)
    {
        $request->validate([
            'current_password' =>  'required',
            'password' => 'required|confirmed',
        ]);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = [
                'message' => "Password Chnaged Successfully",
                'alert-type' => 'success'
            ];
            // session()->flash('message', $notification['message']);
            // session()->flash('alert-type', $notification['alert-type']);

            // dd(session()->all()); // This will show the session data

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => "credentials does not match",
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    // profile create
    public function profileCreate()
    {
        return view('admin.profile.change_profile');
    }
    // Profile Change
    public function profileChange(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with([
                'message' => "User not authenticated",
                'alert-type' => 'error'
            ]);
        }
        if (!empty($request->hasFile('image'))) {
            $userImage = $request->file('image');
            $imageName = uniqid() . '.' . $userImage->getClientOriginalExtension();
            $imagePath = 'backend/assets/images/user/' . $imageName;
            if (!empty($user->image) && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $userImage->move(public_path('backend/assets/images/user/'), $imageName);
        } else {
            $imagePath = Auth::user()->image;
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imagePath;
        $user->save();
        $notificaton = [
            'message' => "Updated Successfully",
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notificaton);
    }
    public function usersList(UsersDataTable $dataTable)
    {

        return $dataTable->render('admin.users.user_list');
    }
    public function createUser()
    {
        return view('admin.users.user_create');
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048|nullable',
            'password' => 'required|min:8|max:64|confirmed'
        ]);
        $user = new User();
        if (!empty($request->hasFile('image'))) {
            $userImage = $request->file('image');
            $imageName = uniqid() . '.' . $userImage->getClientOriginalExtension();

            $imagePath = 'backend/assets/images/user/' . $imageName;
            $userImage->move(public_path('backend/assets/images/user/'), $imageName);
        } else {
            $imagePath = '';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imagePath;
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.users.usersList')->with($notification);
    }
    public function userDelete($id)
    {
        if ($id) {
            $user = User::findOrFail($id);
            if (!empty($user->image) && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $user->delete();
            return response()->json(['status' => "success"]);
        }
    }
    // change user status
    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == "true" ? 1 : 0;
        $user->save();
        return response()->json(['status' => "success", "message" => "Status changed successfully"]);
    }
    // edit user
    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.user_edit', compact('user'));
    }
    // update user
    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email,' . $user->id,

        ]);
        $user = User::findOrFail($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notification = [
            'message' => "Updated Successfully",
            'alert-type' => "success",
        ];
        return redirect()->route('admin.users.usersList')->with($notification);
    }
}
