<?php

namespace Scheduler\App\Http\Controllers\Admin\Room;

use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\Http\Controllers\Controller;

class RoomController extends Controller
{

    /**
     * Create a new resource
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        $room = Room::create($request->all());

        if ($request->has('api')) {
            return response()->json($room, 201);
        }

        return redirect("admin/rooms")->with('success', 'Room has been added');

    }

    /**
     * Update a resource
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * 
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        
        $this->validateData($request);
        
        try {
            $room = Room::find($id);

            $room->name = $request->name;
            $room->description = $request->description;
            $room->status = $request->status;
            $room->type = $request->type;

            if ( $room->save() ) {
                if ( $request->has('api') ) {
                    return response()->json($room, 201);
                }
                return redirect("admin/rooms")->with('success', 'Room has been updated');
            }
        } catch (\ErrorException $e) {

            if ( $request->has('api') ) {
                return response()->json('Unable to update room', 422);
            }
            return redirect("admin/rooms")->with('success', 'Unable to update room');
        }
    }

    /**
     * Validate data
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return void
     */
    private function validateData(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required|integer',
        ]);
    }
}
