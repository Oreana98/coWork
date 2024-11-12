<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->has('size') && in_array($request->size, ['P', 'M', 'G'])) {
            $query->where('size', $request->size); // Filtra según el tamaño
        }

        $rooms = $query->get(); // Obtener las salas filtradas o todas si no se aplica filtro

        return view('rooms.index', compact('rooms'));
    }


    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(RoomRequest $request)
    {
        $room = Room::create([
            'name' => $request->name,
            'size' => $request->size,
            'details' => $request->details,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id); // Obtiene la sala desde la base de datos.
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
