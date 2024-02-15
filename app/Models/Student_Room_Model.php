<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Room_Model extends Model
{
    use HasFactory;


    public function insert($studentId, $roomId)
            {
                try {
                    \DB::table('student__room__models')->insert([
                        'student_id' => $studentId,
                        'room_id' => $roomId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }



    //  public function insert($student, $room)
    //     {
    //         $total = \DB::table('student__room__models')
    //         ->select(\DB::raw('COUNT(student__room__models.student_id) as total'))
    //         ->join('rooms', 'rooms.id', '=', 'student__room__models.room_id')
    //         ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
    //         ->where('rooms.id', $room)
    //         ->groupBy('rooms.id')
    //         ->first(); // Retrieve the first row of the result
        
    //     if ($total) {
    //         $room_type = \DB::table('room_types')
    //             ->where('id', $room->room_type_id)
    //             ->first();
        
    //         if ($total->total < $room_type->capacity) {
    //             \DB::table('student__room__models')->insert($data);
    //         }
    //     }
        
    //     }
}
