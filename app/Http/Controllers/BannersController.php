<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Image;

class BannersController extends Controller
{
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $banner = new Banner;
            if(empty($data['link'])){
                $data['link'] = '';
            }
            $banner->title = $data['title'];
            $banner->link= $data['link'];
            //add image
            if($request ->hasFile('bimage')) {
                //get filename with extension
                $image = $request->file('bimage');
                //get filename without extension
                $input['bimagename'] = time(). '.'.$image->getClientOriginalExtension();
                //get file extension

                // echo "<pre>"; print_r($input['imagename']); die;
                //Upload File
                $destinationPath = public_path('/images/frontend_images/banners');
                $img = Image::make($image->getRealPath());
                $img->resize(484,441, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['bimagename']);

                $banner->image= $input['bimagename'];
            }
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            $banner->status = $status;
            $banner->save();
            return redirect('/admin/view-banners')->with('message_success', 'Banner Added Successfully!');
        }
        return view('admin.banners.add_banner');

    }
    public function viewBanner(){
        $bannerAll = Banner::all();
        $bannerAll= json_decode(json_encode($bannerAll));
        return view('admin.banners.view_banners')->with(compact('bannerAll'));
    }
    public function editBanner(Request $request, $id= null){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['title'])){
                $data['title'] ='';
            }
            if(empty($data['link'])){
                $data['link'] = '';
            }
            //echo "<pre>"; print_r($data); die;
            //add image
            if($request ->hasFile('bimage')) {
                //get filename with extension
                $image = $request->file('bimage');
                //get filename without extension
                $input['bimagename'] = time(). '.'.$image->getClientOriginalExtension();
                //get file extension
                // echo "<pre>"; print_r($input['imagename']); die;
                //Upload File
                $destinationPath = public_path('/images/frontend_images/banners');
                $img = Image::make($image->getRealPath());
                $img->resize(1140,340, function($constraint){ $constraint->aspectRatio(); })->save($destinationPath. '/'.$input['imagename']);
            }else{
                $input['imagename'] = $data['bcurrent_image'];
            }
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            Banner::where('id', $id)->update(['image'=>$input['imagename'],'title'=>$data['title'], 'link'=>$data['link'], 'status'=>$status]);
            return redirect('/admin/view-banners')->with('message_success', 'Banner Updated Successfully!');
        }
        $getBanner = Banner::where('id', $id)->first();
        $getBanner= json_decode(json_encode($getBanner));
        return view('admin.banners.edit_banner')->with(compact('getBanner'));
    }
    public function deleteBanner($id= null){
    Banner::where('id', $id)->delete();
        return redirect()->back()->with('message_success', 'Banner Deleted successfully');
}

}
