<?php

namespace App\Http\Controllers;

use App\Category;
use App\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            //echo "<pre>";print_r($data); die;
            if(empty($data['meta_title'])){
                $data['meta_title']='';
            }
            if(empty($data['meta_description'])){
                $data['meta_description']='';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']='';
            }
            $title=$data['title'];
            $addCms= new CmsPage;
            $addCms->title = $data['title'];
            $addCms->url = $data['url'];
            $addCms->description = $data['description'];
            $addCms->meta_title = $data['meta_title'];
            $addCms->meta_description = $data['meta_description'];
            $addCms->meta_keywords = $data['meta_keywords'];
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            $addCms->status = $status;
            $addCms->save();
            return redirect('admin/view-cms-page')->with('message_success', 'Cms page '.$title. ' Added Successfully');
        }
        return view('admin.pages.add_cms_page');
    }
    public function viewCmsPage(){
        $viewCmsPage = CmsPage::get();
            return view('admin.pages.view_cms_page')->with(compact('viewCmsPage'));

    }
    public function editCmsPage(Request $request, $page=null){
        if($request->isMethod('post')){
            $data= $request->all();
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
                $status = 0;
            }else{
                $status = 1;
            }
            CmsPage::where('id', $page)->update(['title'=>$data['title'], 'url'=>$data['url'], 'description'=>$data['description'], 'status'=>$status, 'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords']]);

            return redirect('/admin/view-cms-page')->with('message_success',$data['title'].' Page Updated Successfully');
        }
        $viewCmsPage= CmsPage::where('id', $page)->first();
        return view('admin.pages.edit_cms_page')->with(compact('viewCmsPage'));
    }
    public function deleteCmsPage($page=null){
        CmsPage::where('id', $page)->delete();
        return redirect()->back()->with('message_success', 'Page Deleted Successfully');

    }
    public function cmsPage($url=null){
        $cmsCount = CmsPage::where(['url'=>$url, 'status'=>1])->count();
        if($cmsCount>0){
            //view page
            $viewCmsPage = CmsPage::where('url', $url)->first();
            $meta_title= $viewCmsPage->meta_title;
            $meta_description= $viewCmsPage->meta_description;
            $meta_keywords= $viewCmsPage->meta_keywords;
        }else{
            abort(404);
        }
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categories = json_decode(json_encode($categories));

        return view('page.cms_page')->with(compact('viewCmsPage', 'categories','meta_title','meta_description', 'meta_keywords' ));
    }

    public function contactUs(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            //echo "<pre>";print_r($data); die;
            $addContact = DB::table('contact_us')->insert(['name'=>$data['name'], 'email'=>$data['email'], 'subject'=>$data['subject'],'message'=>$data['message']]);
            return redirect()->back()->with('message_success', 'Message Sent Successfully');
        }
        $meta_title= "Contact Us - E-shop ecommerce website";
        $meta_description = "Contact Us for queries about product";
        $meta_keywords = "contact us, queries, online shoping, men wears";
        return view('page.contact_us')->with(compact('meta_title', 'meta_description', 'meta_keywords'));
    }
}
