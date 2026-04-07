<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Clarifie;
use App\Models\Usability;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{
    public function AllFeature(){

        $feature = Feature::latest()->get();
        return view('admin.backend.feature.all_feature',compact('feature'));

    } // End Method


    public function AddFeature(){

        return view('admin.backend.feature.add_feature');

    } // End Method


    public function StoreFeature(Request $request){

            Feature::create([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description
            ]);


        $notification = array(
            'message' => 'Feature Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);

    } // End Method


    public function EditFeature($id){

        $feature = Feature::find($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));

    } // End Method


    public function UpdateFeature(Request $request){

        $fea_id = $request->id;

            Feature::find($fea_id)->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description
            ]);


        $notification = array(
            'message' => 'Feature Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);

    } // End Method


    public function DeleteFeature($id){

        Feature::find($id)->delete();

        $notification = array(
            'message' => 'Feature Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method



    // ------------------------------ Clarifies ----------------------------------

    public function GetClarifie(){

        $clarifie = Clarifie::find(1);
        return view('admin.backend.clarifie.get_clarifie',compact('clarifie'));

    } // End Method


    public function UpdateClarifie(Request $request){

        $clar_id = $request->id;
        $clarifie = Clarifie::find($clar_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(302,618)->save(public_path('upload/clarifie/'.$name_gen));
            $save_url = 'upload/clarifie/'.$name_gen;

            if (file_exists(public_path($clarifie->image))) {
                @unlink(public_path($clarifie->image));
            }

            Clarifie::find($clar_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url
            ]);

            $notification = array(
            'message' => 'Clarifie Updated Successfully',
            'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{

            Clarifie::find($clar_id)->update([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
            ]);

            $notification = array(
            'message' => 'Clarifie Updated Successfully',
            'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }


    } // End Method



    // ------------------------------ Usability ----------------------------------

    public function GetUsability(){

        $usability = Usability::find(1);
        return view('admin.backend.usability.get_usability',compact('usability'));

    } // End Method





} // End Main Method
