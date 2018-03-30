<?php

namespace Scheduler\App\Http\Controllers\Admin\Room;

use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\DataTables\RoomDataTable;
use Scheduler\App\Http\Requests\RoomRequest;
use Scheduler\App\Repositories\RoomRepository;
use Scheduler\App\Http\Controllers\Controller;

class RoomController extends Controller
{


    /**
     * Display index form
     *
     * @param   Scheduler\App\DataTables\RoomDataTable $dataTable
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(RoomDataTable $dataTable)
    {
        $data = [
            'breadcrumb' => 'Room Management',
            'page_title' => 'Lists',
        ];

        return $dataTable->render($this->admin_view . 'pages.rooms.index', $data);
    }

    public function create()
    {
        $data = [
            'breadcrumb' => 'Room Management',
            'page_title' => 'Room::update',
            'url'        => url('/admin/rooms/'),
            'types'      => ['Lab', 'Lecture', 'Others'],
            'status'     => [ 1 => 'Active', 0 => 'Inactive'],
        ];

        return admin_view('pages.rooms.form', $data);
    }

    /**
     * Display edit page
     * 
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'breadcrumb' => 'Room Management',
            'page_title' => 'Room::update',
            'url'        => url('/admin/rooms/' . $id),
            'types'      => ['Lab', 'Lecture', 'Others'],
            'room'       => Room::find($id),
            'status'     => [ 1 => 'Active', 0 => 'Inactive'],
            'method'     => 'PUT',
        ];

        return admin_view('pages.rooms.form', $data);
    }

    /**
     * Create a new resource
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Scheduler\App\Repositories\RoomRepository $repo
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
     * @param  Scheduler\App\Repositories\RoomRepository $repo
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

    /**
     * Destroy the given model. We are doing soft deleting only
     *
     * @param  Scheduler\App\Repositories\RoomRepository $repo
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RoomRepository $repo, $id)
    {
        //return $request->all();
        $response = $repo->delete(Room::find($id));

        if ($response) {
            return redirect("admin/rooms")->with('success', 'Room has been deleted');
        }

        return redirect("admin/rooms")->with('error', 'Problem occurred while deleting the room. Please try again.');
    }
}
