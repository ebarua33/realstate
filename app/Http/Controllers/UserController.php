<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function userIndex(){
        return view('user.user_home.index');
    }


    //___________User Profile Show___________//

    public function userProfile(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('user.dashboard.edit_profile', compact('data'));
    }


    //___________User Profile Edit___________//

    public function userStoreProfile(Request $request){
        $id = Auth::user()->id;
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
            $file->move(public_path('upload/user_images'), $filename);
            $data->photo = "upload/user_images/".$filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile Updated Successfuly',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


//___________User Password Show___________//

    public function userUpdatePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('user.change_password', compact('data'));
    }

    //___________User Password Change___________//

    public function userStorePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Current Password Does not Match',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Successfuly Updated',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function userLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    }
}
