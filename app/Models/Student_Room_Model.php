<?php

namespace App\Models;
use App\Models\StdDetails;
use App\Models\Rooms;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Room_Model extends Model
{
    use HasFactory;

    public function stdDetails()
    {
        return $this->hasMany(StdDetails::class);
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }
}
