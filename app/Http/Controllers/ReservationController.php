<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Mostrar una lista de reservas.
     */
    public function index(Request $request)
    {
        $query = Reservation::query();
        if ($request->has('room_id') && $request->room_id != '') {
            $query->where('room_id', $request->room_id);
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }
        $reservations = $query->with(['room', 'user'])->get();
        $rooms = Room::all();
        $users = User::all();

        return view('reservations.index', compact('reservations', 'rooms', 'users'));
    }


    /**
     * Mostrar el formulario para crear una nueva reserva.
     */
    public function create()
    {
        $rooms = Room::all();
        $users = User::all();
        return view('reservations.create', compact('rooms', 'users'));
    }

    /**
     * Almacenar una nueva reserva.
     */
    public function store(ReservationRequest $request)
    {
        $exists = Reservation::where('room_id', $request->room_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'reservation' => 'Ya existe una reserva para esa sala en el rango de tiempo seleccionado.',
            ])->withInput();
        }
        Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'Pendiente',
        ]);

        return redirect()->route('dashboard')->with('success', 'Reserva creada con éxito.');
    }


    /**
     * Mostrar una reserva específica.
     */
    public function show($id)
    {
        $reservation = Reservation::with('room', 'user')->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Mostrar el formulario para editar una reserva existente.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (Auth::user()->id_rol != 1) {
            return redirect()->route('reservations.index')->with('error', 'No tienes permiso para editar esta reserva.');
        }

        $rooms = Room::all();
        $users = User::all();

        return view('reservations.edit', compact('reservation', 'rooms', 'users'));
    }


    /**
     * Actualizar una reserva existente.
     */
    public function update(ReservationUpdateRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return redirect()->route('reservations.index')
            ->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Eliminar una reserva.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva eliminada exitosamente.');
    }
}
