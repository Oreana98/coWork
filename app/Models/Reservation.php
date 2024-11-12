<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    //Relación modelo Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }


    //Relación con el modelo User.

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
