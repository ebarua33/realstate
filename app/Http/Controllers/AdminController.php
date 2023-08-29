<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    //
    //__________Admin index_________//
    public function adminDashboard(){
        return view('admin.index');
    }



    //__________Admin login_________//
    public function adminLogin(){
        return view('admin.admin_login');
    }


    //__________Admin Profile_________//
    public function adminProfile(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.admin_profile', compact('data'));
    }


    //__________Profile Store_________//
    public function adminProfileStore(Request $request, $id){

        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path($data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = "upload/admin_images/".$filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile Updated Successfuly',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    //__________Admin Change Password_________//
    public function adminChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.admin_change_password', compact('data'));
    }

    public function adminUpdatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if(!Hash::check($request->current_password, Auth::user()->password)){
            $notification = array(
                'message' => 'Current Password Does not Match',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password'=>Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Successfuly Updated',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    }
}
