<?php

namespace Rumi\Http\Controllers\Leaser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Rumi\Models\Hostel;
use Auth;
use Carbon\Carbon;
use Rumi\Models\NewRoomBookOrder;
use Rumi\Http\Controllers\Controller;


class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('leaser')->user()->id;
        $allHostels = Hostel::where('leasers_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'response' => $allHostels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'description' => 'required|max:500|min:10',
            'image' => 'required|image|max:2048',
            'location' => 'required|max:250|min:6',
            'no_of_rooms' => 'required|integer',
            'budget' => 'required|integer',
        ]);

        if($validate->fails()){
            return response()->json(['error' => $validate->errors()]);
          }
        $userId = Auth::guard('leaser')->user()->id;
        $hostel = new Hostel;
        


        $hostel->leasers_id = $userId;
        $hostel->description = $request->description;

        if(Input::hasFile('image')){
            $image = Input::file('image');
            $name = $image->getClientOriginalName();
            $now = Carbon::now() . $name;
            $image->move(public_path(). '/images/uploads/leaserhostel/', $now);  
            $hostel->image = $now;
        }
        

        $hostel->location = $request->location;
        $hostel->no_of_rooms = $request->no_of_rooms;
        $hostel->budget = $request->budget;
        $hostel->rooms_left = $request->no_of_rooms;

        $hostel->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Hostel Successfully Created',
            'response' => $hostel,
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leaserId = Auth::guard('leaser')->user()->id;
        
        $hostel = Hostel::where('leasers_id', $leaserId)->find($id);

        $newBookOrders =  NewRoomBookOrder::all()->where('hostel_id', $hostel->id)->where('status', 'udc' );

        return response()->json([
            'status' => 'success',
            'response' => [
                'hostel' => $hostel,
                'newBookOrders' => $newBookOrders,
            ]
        ]);
        
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'description' => 'max:500|min:10',
            'image' => 'image|max:2048',
            'location' => 'max:250|min:6',
            'no_of_rooms' => 'integer',
            'rooms_left' => 'integer',
        ]);

        $hostel = Hostel::find($id);
        $hostel->description = $request->input('description');

        if(Input::hasFile('image')){
            $image = Input::file('image');
            $name = $image->getClientOriginalName();
            $now = Carbon::now() . $name;
            $image->move(public_path(). '/images/uploads/', $now);  
            $hostel->image = $now;
        }

        $hostel->location = $request->input('location');
        $hostel->no_of_rooms  = $request->input('no_of_rooms');
        $hostel->rooms_left = $request->input('rooms_left');

        $hostel->save();
        Session::flash('success', 'Hostel updated successfully');

        return response()->json([
            'status' => 'success',
            'message' => 'Hostel Successfully Updated',
            'response' => $hostel,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostel = Hostel::find($id);

        $hostel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Hostel Deleted Successfully!',
        ]);
    }
    
}
