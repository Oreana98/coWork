@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Lista de Reservas</h1>

    @if(Auth::user()->id_rol == 1) <!-- Solo para administradores -->
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('reservations.index') }}" method="GET" class="d-flex">
            <div class="me-2">
                <select name="room_id" class="form-select" aria-label="Seleccionar sala">
                    <option value="">Filtrar por sala</option>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="me-2">
                <select name="status" class="form-select" aria-label="Seleccionar estado">
                    <option value="">Filtrar por estado</option>
                    <option value="Pendiente" {{ request('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Aceptada" {{ request('status') == 'Aceptada' ? 'selected' : '' }}>Aceptada</option>
                    <option value="Rechazada" {{ request('status') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Reserva
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Sala</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>
                        <span class="badge bg-{{ $reservation->status == 'Aceptada' ? 'success' : ($reservation->status == 'Rechazada' ? 'danger' : 'secondary') }}">
                            {{ $reservation->status }}
                        </span>
                    </td>
                    <td>
                        @if(Auth::user()->id_rol == 1) <!-- Solo para administradores -->
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        @endif

                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta reserva?')">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No hay reservas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection