@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Editar Sala') }}</h1>

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo de Nombre de la Sala -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre de la Sala') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $room->name) }}">
        </div>

        <!-- Campo de Detalles -->
        <div class="mb-3">
            <label for="details" class="form-label">{{ __('Detalles') }}</label>
            <input type="text" name="details" id="details" class="form-control" value="{{ old('details', $room->details) }}">
        </div>

        <!-- Campo de Tamaño -->
        <div class="mb-3">
            <label for="size" class="form-label">{{ __('Tamaño') }}</label>
            <select name="size" id="size" class="form-control">
                <option value="P" {{ old('size', $room->size) == 'P' ? 'selected' : '' }}>{{ __('Pequeña') }}</option>
                <option value="M" {{ old('size', $room->size) == 'M' ? 'selected' : '' }}>{{ __('Mediana') }}</option>
                <option value="G" {{ old('size', $room->size) == 'G' ? 'selected' : '' }}>{{ __('Grande') }}</option>
            </select>
        </div>

        <!-- Botón de Actualización -->
        <button type="submit" class="btn btn-primary">{{ __('Actualizar Sala') }}</button>
    </form>
</div>
@endsection