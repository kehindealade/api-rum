<?php

namespace Rumi\Http\Controllers\Roomer;

use Illuminate\Http\Request;
use Rumi\Hostel;
use Rumi\Http\Controllers\Controller;

class RoomerRoomController extends Controller
{
    
    public function index(){
    	$rooms = Hostel::where('rooms_left', '!=', 0)->get();
    	return response()->json([
            'status' => 'success',
            'response' => $rooms,
        ]);
    }

    public function showRoom($id){
        $hostel = Hostel::find($id);
        
        if($hostel->rooms_left == 0){
            return response()->json([
                'status' => 'error',
                'response' => 'Room is full already',
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            'response' => $hostel,
        ]);
    }

}
