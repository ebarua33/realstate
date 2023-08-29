<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    //

    public function amenitiesAll(){
        $datas = Amenities::latest()->get();
        return view('admin.admin_amenities.all_amenities', compact('datas'));
    }

    public function amenitiesAdd()
    {
        return view('admin.admin_amenities.add_amenities');
    }

    public function amenitiesStore(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:amenities',
        ]);

        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);

        $notification = array(
            'message' => 'Amenitie Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function amenitiesEdit($id)
    {
        $datas = Amenities::find($id);
        return view('admin.admin_amenities.edit_amenities', compact('datas'));
    }


    public function amenitiesUpdate(Request $request, $id)
    {

        Amenities::findOrFail($id)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        $notification = array(
            'message' => 'Amenitie Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.amenities')->with($notification);
    }

    public function amenitiesDestroy($id)
    {
        $data = Amenities::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Amenitie Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


}
