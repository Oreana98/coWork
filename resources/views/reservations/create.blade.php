@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Crear Nueva Reserva</h1>

    <div class="card shadow-lg">
        <div class="card-body">

            <!-- Mostrar errores -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="room_id" class="form-label">Sala</label>
                    <select name="room_id" id="room_id" class="form-select">
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="user_id_display" value="{{ Auth::user()->name }}" disabled>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Hora de Inicio</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">Hora de Fin</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const startTimeInput = document.getElementById('start_time');
                        const endTimeInput = document.getElementById('end_time');
                        const dateInput = document.getElementById('date');

                        startTimeInput.addEventListener('change', function() {
                            const currentDate = new Date();
                            const selectedDate = new Date(dateInput.value);
                            const startTime = startTimeInput.value;

                            // Obtener solo la hora y minutos actuales
                            const currentHours = currentDate.getHours();
                            const currentMinutes = currentDate.getMinutes();
                            const currentTime = `${String(currentHours).padStart(2, '0')}:${String(currentMinutes).padStart(2, '0')}`;

                            const isToday = dateInput.value === currentDate.toISOString().split('T')[0];

                            // Comparar solo la hora si la fecha seleccionada es hoy
                            if (isToday && startTime < currentTime) {
                                alert('La Hora de Inicio debe ser igual o mayor a la hora actual.');
                                startTimeInput.value = '';
                                return;
                            }

                            if (startTime) {
                                const [hours, minutes] = startTime.split(':').map(Number);
                                const maxEndTime = new Date(1970, 0, 1, hours, minutes + 60); // Máximo 1 hora más
                                endTimeInput.min = startTime;
                                endTimeInput.max = maxEndTime.toTimeString().substring(0, 5); // Formato HH:mm
                                endTimeInput.value = '';
                            }
                        });

                        endTimeInput.addEventListener('change', function() {
                            const [startHours, startMinutes] = startTimeInput.value.split(':').map(Number);
                            const [endHours, endMinutes] = endTimeInput.value.split(':').map(Number);

                            const startDateTime = new Date(1970, 0, 1, startHours, startMinutes);
                            const endDateTime = new Date(1970, 0, 1, endHours, endMinutes);

                            if (endDateTime - startDateTime > 60 * 60 * 1000) {
                                alert('La hora de fin no puede ser más de una hora después de la hora de inicio.');
                                endTimeInput.value = '';
                            }
                        });
                    });
                </script>



                <div class="d-flex justify-content-between">
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection