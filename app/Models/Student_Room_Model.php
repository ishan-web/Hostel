<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Room_Model extends Model
{
    use HasFactory;


    // public function insert($studentId, $roomId)
    //         {
    //             try {
    //                 \DB::table('student__room__models')->insert([
    //                     'student_id' => $studentId,
    //                     'room_id' => $roomId,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ]);
    //                 return true;
    //             } catch (\Exception $e) {
    //                 return false;
    //             }
    //         }

     public function insert($data, $room)
        {
            $total = \DB::table('student__room__models')
                ->select(\DB::raw('COUNT(student__room__models.student_id) as total'))
                ->join('rooms', 'rooms.id', '=', 'student__room__models.room_id')
                ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
                ->where('rooms.id', $room)
                ->groupBy('rooms.id')
                ->first(); // Retrieve the first row of the result

                
            // Check if $total is null
            if ($total !== null) {
                // The query returned a valid result, so continue with your logic
                $room_type = \DB::table('room_types')
                    ->join('rooms', 'rooms.room_type_id', '=', 'room_types.id')
                    ->where('rooms.id', $room)
                    ->first();

                if ($total->total < $room_type->capacity) {
                    \DB::table('student__room__models')->insert($data);
                    return true;
                }
                else{
                    return false;
                }
            } else {

                \DB::table('student__room__models')->insert($data); 
                return true;           
            }          
        
        }
        
        public function update(array $data = [], array $options = [])
        {


            $total = \DB::table('student__room__models')
                ->select(\DB::raw('COUNT(student__room__models.student_id) as total'))
                ->join('rooms', 'rooms.id', '=', 'student__room__models.room_id')
                ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
                ->where('rooms.id', $data['room_id'])
                ->groupBy('rooms.id')
                ->first(); // Retrieve the first row of the result
        
            if ($total !== null) {
                // Retrieve the room type information
                $room_type = \DB::table('room_types')
                    ->join('rooms', 'rooms.room_type_id', '=', 'room_types.id')
                    ->where('rooms.id', $data['room_id'])
                    ->first();
        
                // Check if the total number of students is less than the room capacity
                if ($total->total < $room_type->capacity) {
                    // If the condition is met, proceed with the update
                    \DB::table('student__room__models')->where('id', $options['id'])->update($data);
                    return true;
                }
                else
                {
                    return false;

                }
            } else {
                // If there are no students allocated to the room, proceed with the update directly
                \DB::table('student__room__models')->where('id', $options['id'])->update($data);
                return true;
            }
        }
        
}
