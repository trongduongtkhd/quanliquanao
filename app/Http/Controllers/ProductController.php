<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
      public function add_product()
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

   public function all_product()
{
    $all_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->orderby('tbl_product.product_id', 'desc')->get(); 
    $manager_product = view('admin.all_product')->with('all_product', $all_product);
    return view('admin_layout')->with('admin.all_product', $manager_product);
}
    public function save_product(Request $request)
    {
        $data = array();
        //  $data['category_id'] = uniqid();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            return Redirect::to('add-product')->with('product_message', 'Thêm sản phẩm thành công');
        }
         $data['product_image'] = '';
       DB::table('tbl_product')->insert($data);
       return Redirect::to('all-product')->with('product_message', 'Thêm sản phẩm thành công');
    }
    public function unactive_product($product_id){
       DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
      return Redirect::to('all-product')->with('product_message', 'Không kích hoạt  sản phẩm thành công');
    }
     public function active_product($product_id){
       DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
      return Redirect::to('all-product')->with('product_message', ' kích hoạt   sản phẩm thành công');
    }
    public function edit_product($product_id){
           $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
           $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
         $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request , $product_id){
        $data = array();
         $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
       if($get_image){
            $new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            return Redirect::to('all-product')->with('product_message', 'Cập nhật sản phẩm thành công');
        }
       
       DB::table('tbl_product')->where('product_id', $product_id)->update($data);
       return Redirect::to('all-product')->with('product_message', 'Cập nhật  sản phẩm thành công');
    }
    public function delete_product( $product_id){
         DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('/all-product')->with('product_message', 'Xóa sản phẩm   thành công');
    }
    // end admin page 
public function details_product($product_id){
    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
     $details_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
    ->where('tbl_product.product_id',$product_id)->get(); 
    return view('pages.sanpham.show_details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $details_product);
}
    
}