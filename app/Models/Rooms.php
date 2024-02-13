<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;


class Rooms extends Model
{
    use HasFactory;

    
    public function users()
    {
        return $this->hasMany(Users::class);
    }

}
