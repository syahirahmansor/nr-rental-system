<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'file_path',
        'original_name',
    ];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
