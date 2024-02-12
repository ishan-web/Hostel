<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rooms;

class Room_types extends Model
{
    use HasFactory;

            public function rooms()
        {
            return $this->hasMany(Rooms::class);
        }

}
