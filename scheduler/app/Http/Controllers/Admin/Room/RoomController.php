<?php

namespace Scheduler\App\Http\Controllers\Admin\Room;

use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\Http\Requests\RoomRequest;
use Scheduler\App\Repositories\RoomRepository;
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
    public function store(RoomRequest $request, RoomRepository $repo)
    {
        try {

            $repo->saveFormRequest($request, new Room());

            return redirect("admin/rooms")->with('success', 'Room has been added');
            
        } catch (Exception $e) {

            return redirect("admin/rooms")->with('error', $e->getMessage());

        }
    }

    /**
     * Update a resource
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * 
     * @return mixed
     */
    public function update(RoomRequest $request, RoomRepository $repo, $id)
    {

        $room = Room::find($id);

        try {

            $repo->saveFormRequest($request, $room);
            return redirect("admin/rooms")->with('success', 'Room has been updated');
            
        } catch (Exception $e) {
            return redirect("admin/rooms")->with('error', $e->getMessage());
        }

    }
}
