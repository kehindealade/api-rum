<?php

namespace Rumi\Http\Controllers\Leaser;

use Illuminate\Http\Request;
use Rumi\Models\NewRoomBookOrder;
use Rumi\Http\Controllers\Controller;

class ManageRoomBookOrderController extends Controller
{
    public function displayAllOrderOnAllHostels(){
    	$allOrders = NewRoomBookOrder::all();
    	return view('leaser.hostel.book.manage.index', ['allOrders' => $allOrders]); 
    }

    public function displayBookedOrderOnHostel($hid){
        $hostelOrders = NewRoomBookOrder::all()->where('hostel_id', $hid);
        return response()->json([
            'status' => 'success',
            'response' => $hostelOrders,
        ]);
    }
}
