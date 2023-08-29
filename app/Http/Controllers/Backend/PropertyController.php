<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PHPUnit\Framework\Constraint\Count;

use function PHPUnit\Framework\fileExists;

class PropertyController extends Controller
{
    //

    public function propertyAll(){
        $datas = Property::latest()->with('propertyType')->get();
        return view('admin.admin_property.all_property', compact('datas'));
    }

    public function propertyAdd(){
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $agent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('admin.admin_property.add_property', compact('propertyType', 'amenities', 'agent'));
    }

    public function propertyStore(Request $request){

        //_____________Harunscpi Id Generator Package_______//
        $pcode = IdGenerator::generate([
            'table' => 'properties',
            'field' => 'property_code',
            'length' => 5,
            'prefix' => 'PC',
        ]);

        $amen = $request->amenities_id;
        $amenities_id = implode(",", $amen);


        //_____________Thumbnail With Image Intervention Package_______//
        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/'.$name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        //_____________End Thumbnail With Image Intervention Package_______//

        $property_id = Property::insertGetId([  //Also can used insert function
            'propertytype_id' => $request->propertytype_id,
            'amenities_id' => $amenities_id,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'property_thumbnail' => $save_url,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'property_size' => $request->property_size,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_name' => $request->property_name,
            'property_name' => $request->property_name,
            'created_at' => Carbon::now(),

        ]);

        //_____________Multi Images Store Here_______//
        $images = $request->file('photo_name');
        foreach($images as $img){
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(370, 250)->save('upload/property/multiple_image/' . $make_name);
            $imagePath = 'upload/property/multiple_image/' . $make_name;
            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $imagePath,
            ]);
        } //_____________End Foreach Loop_______//

        //_____________End Multi Images Store Here_______//


         //_____________Facility Store Here_______//
        $facilities = Count($request->facility_name);
        if($facilities != NULL){
            for ($i = 0; $i < $facilities; $i++) {
                Facility::insert([
                    'property_id' => $property_id,
                    'facility_name' => $request->facility_name[$i],
                    'distance' => $request->distance[$i],
                ]);
            }
        }

        //_____________End Facility Store Here_______//
        //****Note: It can be also done like Multi image part*****//


        $notification = array(
            'message' => 'Property Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notification);

    }


    public function propertyEdit($id){
        $property = Property::find($id);
        $property_anem = explode(',', $property->amenities_id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $agent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('admin.admin_property.edit_property', compact('property', 'propertyType', 'amenities', 'agent', 'property_anem', 'multiImage'));
    }

    public function propertyUpdate(Request $request, $id){

        $property = Property::findOrFail($id);

        $amen = $request->amenities_id;
        $amenities_id = implode(",", $amen);

        //_____________Thumbnail With Image Intervention Package_______//
        if(!empty($request->file('property_thumbnail'))){
            $image = $request->file('property_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
            $save_url = 'upload/property/thumbnail/' . $name_gen;
            if (!empty($property->property_thumbnail)) {  //   file_exists()
                unlink(public_path($property->property_thumbnail));
            }
        }
        else{
            $save_url = $property->property_thumbnail;
        }

        //_____________End Thumbnail With Image Intervention Package_______//

        $property->update([
            'propertytype_id' => $request->propertytype_id,
            'amenities_id' => $amenities_id,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
           // 'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'property_thumbnail' => $save_url,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'property_size' => $request->property_size,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_name' => $request->property_name,
            'property_name' => $request->property_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notification);
    }
}
