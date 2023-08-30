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
use PhpParser\Parser\Multiple;
use PHPUnit\Framework\Constraint\Count;

use function PHPUnit\Framework\fileExists;

class PropertyController extends Controller
{
    //

    public function propertyAll()
    {
        $datas = Property::latest()->with('propertyType')->get();
        return view('admin.admin_property.all_property', compact('datas'));
    }

    public function propertyAdd()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $agent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('admin.admin_property.add_property', compact('propertyType', 'amenities', 'agent'));
    }

    public function propertyStore(Request $request)
    {

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
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/' . $name_gen;

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
        foreach ($images as $img) {
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
        if ($facilities != NULL) {
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


    public function propertyEdit($id)
    {
        $facilities = Facility::where('property_id', $id)->get();

        $property = Property::find($id);
        $property_anem = explode(',', $property->amenities_id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $agent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('admin.admin_property.edit_property', compact('property', 'propertyType', 'amenities', 'agent', 'property_anem', 'multiImage','facilities'));
    }

    public function propertyUpdate(Request $request, $id)
    {

        $property = Property::findOrFail($id);

        $amen = $request->amenities_id;
        $amenities_id = implode(",", $amen);

        //_____________Thumbnail With Image Intervention Package_______//
        if (!empty($request->file('property_thumbnail'))) {
            $image = $request->file('property_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
            $save_url = 'upload/property/thumbnail/' . $name_gen;
            if (!empty($property->property_thumbnail)) {  //   file_exists()
                unlink(public_path($property->property_thumbnail));
            }
        } else {
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
        if($request->facility_name !=null){
            Facility::where('property_id', $id)->delete();
            $facilities = Count($request->facility_name);
            if ($facilities != NULL) {
                for ($i = 0; $i < $facilities; $i++) {
                    if($request->facility_name[$i]==null){
                        continue;
                    }
                    Facility::insert([
                        'property_id' => $id,
                        'facility_name' => $request->facility_name[$i],
                        'distance' => $request->distance[$i],
                    ]);
                }
            }
        }

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notification);
    }


    public function propertyUpdateMultiimg(Request $request)
    {
        if (!empty($request->photo_name)) {
            $images = $request->photo_name;
            foreach ($images as $id => $img) {
                $data = MultiImage::find($id);
                unlink($data->photo_name);
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(370, 250)->save('upload/property/multiple_image/' . $make_name);
                $imagePath = 'upload/property/multiple_image/' . $make_name;
                MultiImage::where('id', $id)->update([
                    'photo_name' => $imagePath,
                    'updated_at' => Carbon::now(),
                ]);
            }
            $notification = array(
                'message' => 'Property Multiple Image Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        return redirect()->back();
    }

    public function propertyDeleteMultiimg($id){
        $img = MultiImage::find($id);
        unlink($img->photo_name);
        $img->delete();
        $notification = array(
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function propertyStoreMultiimg(Request $request, $id){
        $image = $request->photo_name;
        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/multiple_image/' . $make_name);
        $imagePath = 'upload/property/multiple_image/' . $make_name;
        MultiImage::insert([
            'property_id' => $id,
            'photo_name' => $imagePath,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Image Stored Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

    public function propertyDestroy($id){
        $property = Property::find($id);
        if($property->property_thumbnail != null){
            unlink(public_path($property->property_thumbnail));
        }
        $mulImg = MultiImage::where('property_id', $id)->get();
        foreach($mulImg as $img){
            if ($img->photo_name != null) {
                unlink(public_path($img->photo_name));
            }
            MultiImage::where('property_id', $id)->delete();
        }
        Facility::where('property_id', $id)->delete();
        $property->delete();
        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
