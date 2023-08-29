<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = []; // all filled in migration table is fillable now

    public function propertyType(){
        return $this->belongsTo(PropertyType::class, 'propertytype_id', 'id');
    }
}
