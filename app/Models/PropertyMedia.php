<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'file_path',
    ];

    // Relationship to Property model
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function watermarkedPhoto()
    {
        return $this->hasOne(WatermarkedPhoto::class, 'property_media_id');
    }
}
