<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if(Session::get('adminType')['categories_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['meta_title'])){
                $data['meta_title']='';
            }
            if(empty($data['meta_description'])){
                $data['meta_description']='';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']='';
            }

            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->status = $status;
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];

            $category->save();
            return redirect('/admin/view-category')->with('message_success', 'Category Added Successfully!');
        }
        $level= Category::where(['parent_id'=> 0])->get();
        //echo "<pre>"; print_r($level); die;
        return view('admin.categories.add_category')->with(compact('level'));
    }
    public function viewCategory(){
        if(Session::get('adminType')['categories_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
       // echo "<pre>"; print_r($categories); die;
        return view('admin.categories.view_category')->with(compact('categories'));
    }
    public function editCategory(Request $request, $id=Null){
        if(Session::get('adminType')['categories_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['meta_title'])){
                $data['meta_title']='';
            }
            if(empty($data['meta_description'])){
                $data['meta_description']='';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']='';
            }
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            //echo "<pre>"; print_r($data); die;
            $category = Category::where('id', $id)->update([
                'name' => $data['category_name'],
                'description' => $data['description'],
                'parent_id' => $data['parent_id'],
                'url' => $data['url'],
                'meta_title' =>$data['title'],
                'meta_description' =>$data['meta_description'],
                'meta_keywords' =>$data['meta_keywords'],
                'status' => $status,
            ]);
            return redirect('/admin/view-category')->with('message_success', 'Category Updated Successfully!');
        }
        $categoryDetail = Category::where('id', $id)->first();
        $categoryDetail = json_decode(json_encode($categoryDetail));
        $level= Category::where(['parent_id'=> 0])->get();

       // echo "<pre>"; print_r($categorydetail); die;
        return view('admin.categories.edit_category')->with(compact('categoryDetail','level'));
    }
    public function deleteCategory($id = Null){
        if(Session::get('adminType')['categories_access'] == 0){
            return redirect('/admin/dashboard')->with('message_error', 'Access Denied');
        }
        if(!empty($id)){
            Category::where(['id'=> $id])->delete();
            return redirect()->back()->with('message_success', 'Category Deleted Successfully!');
        }
    }
}
