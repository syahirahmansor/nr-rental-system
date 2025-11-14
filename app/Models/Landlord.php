<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model 
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'address',
        'phoneno',
        'dob',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'landlord_id');
    }

    // New relationship for documents
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'landlord_id');
    }


}
