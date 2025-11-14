<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Yaml\Tests\YamlTest;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'AppointmentNumber',
        'AppointmentDate',
        'AppointmentTime_id',
        'name',
        'student_id',
        'landlord_id',
        'Message',
        'ApplyDate',
        'ApplyDate',
        'Remark',
        'Status',
        'DocMsg'
    ];
    protected $dates = ['AppointmentDate'];
    protected $primary = ['id'];
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'landlord_id');
    }

    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function bookingTime()
    {
        return $this->belongsTo(BookingTime::class, 'AppointmentTime_id');
    }

}