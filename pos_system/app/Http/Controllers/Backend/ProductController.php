<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Suplier;
use App\MOdels\Category;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;


class ProductController extends Controller
{
    //
    public function AllProduct(){
        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));
    }

    public function AddProduct(){
        $category = Category::latest()->get();
        $supplier = Suplier::latest()->get();
        return view('backend.product.add_product', compact('category', 'supplier'));
    }

    public function StoreProduct(Request $request){
        
        $pcode = IdGenerator::generate(['table' => 'products','field'=>'product_code','length'=> 5,'prefix'=> 'PC']);

        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;
        Product::insert([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,           
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
             ); 
        return redirect()->route('all-product')->with($notification);
    }

    public function EditProduct($id){
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Suplier::latest()->get();

        return view('backend.product.edit_product', compact('product','category','supplier'));
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->id;

        if($request->file('product_image')){
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;
        
        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,           
            'created_at' => Carbon::now(),
        ]);
            
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
                 ); 
            return redirect()->route('all-product')->with($notification);
    
        }else{
        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'created_at' => Carbon::now(),

            ]);
    
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
                 ); 
            return redirect()->route('all-product')->with($notification);
    }
}

public function DeleteProduct($id){
    $product_image = Product::findOrFail($id);
        $img = $product_image->product_image; 
        unlink($img);

        Product::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
             ); 
        return redirect()->route('all-product')->with($notification);
}

public function BarcodeProduct($id){
    $product = Product::findOrFail($id);
    return view('backend.product.add_barcode', compact('product'));  
}

public function ImportProduct(){
    return view('backend.product.import_product');
}

public function Export(){
    return Excel::download(new ProductExport,'products.xlsx');
}

public function Import(Request $request){
    Excel::import(new ProductImport, $request->file('import_file'));

    
    $notification = array(
        'message' => 'Product Imported Successfully',
        'alert-type' => 'success'
         );  
    return redirect()->back()->with($notification);
}

}
