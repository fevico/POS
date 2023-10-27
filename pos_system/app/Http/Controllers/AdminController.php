<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Illuminate\Support\Facades\Storage;
 

class AdminController extends Controller
{
    //
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'
        );

        return redirect('/logout')->with($notification);
    }

    public function AdminLogoutPage(){
        return view('admin.admin_logout');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data['photo'] = $filename; 
        }
            $data->save(); 
            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
    }
public function ChangePassword(){
    return view('admin.change_password');
}

public function UpdatePassword(Request $request){
    // validation 
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',

    ]);

    /// Match The Old Password 
    if (!Hash::check($request->old_password, auth::user()->password)) {

         $notification = array(
        'message' => 'Old Password Dones not Match!!',
        'alert-type' => 'error'
         ); 
        return back()->with($notification);

    }

    //// Update The New Password 

    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);

        $notification = array(
        'message' => 'Password Change Successfully',
        'alert-type' => 'success'
         ); 
        return back()->with($notification);
}

// admin user all method 
public function AllAdmin(){
    $user = User::latest()->get();
    return view('backend.admin.all_admin', compact('user'));
}

public function AddAdmin(){
    $roles = Role::all();
    return view('backend.admin.add_admin', compact('roles'));
}

public function StoreAdmin(Request $request){
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->save();

    if($request->roles){
        $user->assignRole($request->roles);
    }

    $notification = array(
        'message' => 'New Admin Created Successfully',
        'alert-type' => 'success'
         ); 
        return redirect()->route('all.admin')->with($notification);
}

public function EditAdmin($id){
    $roles = Role::all();
    $adminUser = User::findOrFail($id);
    return view('backend.admin.edit_admin', compact('roles','adminUser'));  
}

public function UpdateAdmin(Request $request){
    $admin_id = $request->id;

    $user = User::findOrFail($admin_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();

    $user->roles()->detach();
    if($request->roles){
        $user->assignRole($request->roles);
    }

    $notification = array(
        'message' => 'Admin Updated Successfully',
        'alert-type' => 'success'
    ); 
    return redirect()->route('all.admin')->with($notification);
}

public function DeleteAdmin($id){
    $user = User::findOrFail($id);
    if(!is_null($user)){
        $user->delete();
    }
    
    $notification = array(
        'message' => 'Admin Deleted Successfully',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($notification);
}

// database backup
public function DatabaseBackup(){
    return view('admin.db_backup')->with('files',File::allFiles(storage_path('/app/Fevico')));
}

public function BackupNow(){
    \Artisan::call('backup:run');

    
    $notification = array(
        'message' => 'Database Backup Successfully',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($notification);
}

public function DownloadDatabase($getFilename){
    $path = storage_path('app\Fevico/'.$getFilename);
    return response()->download($path);
}

public function DeleteDatabase($getFilename){
    Storage::delete('Fevico/'.$getFilename);

    
    $notification = array(
        'message' => 'Database Deleted Successfully',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($notification);
}

}
