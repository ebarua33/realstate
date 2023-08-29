<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    public function propertyAllType(){
        $types = PropertyType::latest()->get();
        return view('admin.admin_property_type.all_type', compact('types'));
    }

    public function propertyAddType(){
        return view('admin.admin_property_type.add_type');
    }

    public function propertyStoreType(Request $request){
        $request->validate([
            'type_name' => 'required|unique:property_types',
            'type_icon' => 'required',
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notification = array(
            'message' => 'Property Type Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function propertyEditType($id){
        $types = PropertyType::find($id);
        return view('admin.admin_property_type.edit_type', compact('types'));
    }

    public function propertyUpdateType(Request $request, $id){

        PropertyType::findOrFail($id)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('property.all.type')->with($notification);
    }

    public function propertyDestroyType($id){
        $data = PropertyType::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
