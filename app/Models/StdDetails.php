<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StdDetails extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // public function getCost($id)
    // {
    //     $cost = \DB::table('std_details')
    //         ->select('room_types.cost')
    //         ->join('student__room__models', 'student__room__models.student_id', '=', 'std_details.id')
    //         ->join('rooms', 'rooms.id', '=', 'student__room__models.room_id')
    //         ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
    //         ->where('std_details.id', $id)
    //         ->first();
    
    //     return $cost; 
    // }
    
}
