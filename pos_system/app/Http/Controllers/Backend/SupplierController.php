<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class SupplierController extends Controller
{
    //
    public function AllSupplier(){
        $supplier = Suplier::latest()->get();
        return view('backend.supplier.all_supplier', compact('supplier'));
    }

    public function AddSupplier(){
        return view('backend.supplier.add_supplier');
    }

    public function StoreSupplier(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:supliers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'type' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;
        Suplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,           
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
             ); 
        return redirect()->route('all-supplier')->with($notification);
    }

    public function EditSupplier($id){
        $supplier = Suplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));

    }

    public function UpdateSupplier(Request $request){
        $supplier_id = $request->id;
        if($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/supplier/'.$name_gen);
            $save_url = 'upload/supplier/'.$name_gen;    
            Suplier::findOrFail($supplier_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,           
            'created_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
                 ); 
            return redirect()->route('all-supplier')->with($notification);
    
        }else{
            Suplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
                 ); 
            return redirect()->route('all-supplier')->with($notification);
        }

}

public function DeleteSupplier($id){
    $supplier_image = Suplier::findOrFail($id);
    $img = $supplier_image->image; 
    unlink($img);

    Suplier::findOrFail($id)->delete();
    
    $notification = array(
        'message' => 'Supplier Deleted Successfully',
        'alert-type' => 'success'
         ); 
    return redirect()->back()->with($notification);
}

public function DetailsSupplier($id){
    $supplier = Suplier::findOrFail($id);
    return view('backend.supplier.details_supplier', compact('supplier'));

}

}
