<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    public function propertyAllType(){
        $type = PropertyType::latest()->get();
        return view('admin.admin_property_type.all_type', compact('type'));
    }
}
