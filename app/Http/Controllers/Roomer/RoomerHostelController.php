<?php

namespace Rumi\Http\Controllers\Roomer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Rumi\Http\Controllers\Controller;
use Validator;
use Rumi\Models\RoomerHostel;

class RoomerHostelController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'no_of_roommates' => 'required|integer',
            'no_left' => 'required|integer',
            'description' => 'required|min:5|max:500',
            'location' => 'required|string|max:50',
            'image' => 'required|image|max:2048',
            'amount' => 'required|integer',
        ]);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()]);
        }

        $roomerId = auth()->guard('roomer')->user()->id;
        $roomerHostel = new RoomerHostel;
        $roomerHostel->roomer_id = $roomerId;
        $roomerHostel->no_of_roommates = $request->no_of_roommates;
        $roomerHostel->no_left = $request->no_left;
        $roomerHostel->description = $request->description;
        $roomerHostel->location = $request->location;

        if(Input::hasFile('image')){
            $image = Input::file('image');
            $name = $image->getClientOriginalName();
            $now = Carbon::now() . $name;
            $image->move(public_path(). '/images/uploads/roomerhostel/', $now);  
            $roomerHostel->image = $now;
        }

        $roomerHostel->amount = $request->amount;
        $roomerHostel->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Hostel successfully created',
        ]);

    }

    public function update(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'no_of_roommates' => 'required|integer',
            'no_left' => 'required|integer',
            'description' => 'required|min:5|max:500',
            'location' => 'required|string|max:50',
            'image' => 'required|image|max:2048',
            'amount' => 'required|integer',
        ]);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()]);
        }

        $roomerId = auth()->guard('roomer')->user()->id;
        $roomerHostel = RoomerHostel::find($id);
        
        $roomerHostel->no_of_roommates = $request->input('no_of_roommates');
        $roomerHostel->no_left = $request->input('no_left');
        $roomerHostel->description = $request->input('description');
        $roomerHostel->location = $request->input('location');

        if(Input::hasFile('image')){
            $image = Input::file('image');
            $name = $image->getClientOriginalName();
            $now = Carbon::now() . $name;
            $image->move(public_path(). '/images/uploads/roomerhostel/', $now);  
            $roomerHostel->image = $now;
        }

        $roomerHostel->amount = $request->input('amount');
        $roomerHostel->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Hostel successfully updated',
        ]);
    }

    public function showAllRoomerHostels(){
        $roomerId = auth()->guard('roomer')->user()->id;
        $roomerHostel = RoomerHostel::where('roomer_id', '!=', $roomerId)->get();

        return response()->json([
            'status' => 'success',
            'response' => $roomerHostel,
        ]);
    }

    public function showMyHostels(){
        $roomerId = auth()->guard('roomer')->user()->id;
        $roomerHostel = RoomerHostel::where('roomer_id', $roomerId)->get();

        return response()->json([
            'status' => 'success',
            'response' => $roomerHostel,
        ]);
    }
}
