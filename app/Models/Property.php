<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    // Specify fillable fields for mass assignment
    protected $fillable = [
        'landlord_id',
        'property_name',
        'property_number',
        'price',
        'types',
        'utilities',
        'rooms',
        'parking',
        'furnished',
        'map_link',
        'tenant',
        'contact_number',
        'contract',
        'apply_date',
        'message',
        'remark',
        'status',
    ];

    // Relationship with the landlord model
    public function landlord()
{
    return $this->belongsTo(Landlord::class, 'landlord_id');
}

public function media()
{
    return $this->hasMany(PropertyMedia::class, 'property_id', 'id');
}

public function getStatusButtonClassAttribute()
{
    return match ($this->status) {
        'Active' => 'btn-success',
        'Cancelled' => 'btn-danger',
        'In Progress' => 'btn-warning',
        default => 'btn-secondary',
    };
}

}
