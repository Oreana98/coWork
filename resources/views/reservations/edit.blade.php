@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Editar Reserva</h1>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="room_id" class="form-label">Sala</label>
                    <select name="room_id" id="room_id" class="form-select">
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario</label>
                    <select name="user_id" id="user_id" class="form-select">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $reservation->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $reservation->date }}" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Hora de Inicio</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $reservation->start_time }}" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">Hora de Fin</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $reservation->end_time }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Pendiente" {{ $reservation->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Aceptada" {{ $reservation->status == 'Aceptada' ? 'selected' : '' }}>Aceptada</option>
                        <option value="Rechazada" {{ $reservation->status == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection