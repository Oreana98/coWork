@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ __('Gestionar Salas') }}</h1>

    <!-- Formulario de Filtro -->
    <form action="{{ route('rooms.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="size" class="form-label">{{ __('Filtrar por Tamaño') }}</label>
                <select name="size" id="size" class="form-select">
                    <option value="">{{ __('Todos los tamaños') }}</option>
                    <option value="P" {{ request('size') == 'P' ? 'selected' : '' }}>{{ __('Pequeña') }}</option>
                    <option value="M" {{ request('size') == 'M' ? 'selected' : '' }}>{{ __('Mediana') }}</option>
                    <option value="G" {{ request('size') == 'G' ? 'selected' : '' }}>{{ __('Grande') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Filtrar') }}</button>
            </div>
        </div>
    </form>

    <!-- Botón para Crear una Nueva Sala -->
    <a href="{{ route('rooms.create') }}" class="btn btn-success mb-3">{{ __('Crear Sala') }}</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabla de Salas -->
    <table class="table table-hover table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center py-3">{{ __('ID') }}</th>
                <th class="text-center py-3">{{ __('Nombre') }}</th>
                <th class="text-center py-3">{{ __('Tamaño') }}</th>
                <th class="text-center py-3">{{ __('Detalle') }}</th>
                <th class="text-center py-3">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td class="text-center py-3">{{ $room->id }}</td>
                <td class="text-center py-3">{{ $room->name }}</td>
                <td class="text-center py-3">
                    @if($room->size == 'P')
                    {{ __('Pequeña') }}
                    @elseif($room->size == 'M')
                    {{ __('Mediana') }}
                    @else
                    {{ __('Grande') }}
                    @endif
                </td>
                <td class="py-3">{{ $room->details }}</td>
                <td class="text-center py-3">
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">{{ __('Editar') }}</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta sala?')">{{ __('Eliminar') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection