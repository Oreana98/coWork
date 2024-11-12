<!-- resources/views/rooms/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Crear Sala') }}</h1>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre de la Sala') }}</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">{{ __('Detalles') }}</label>
            <input type="text" name="details" id="details" class="form-control">
        </div>
        <div class="mb-3">
            <label for="size" class="form-label">{{ __('Tamaño') }}</label>
            <select name="size" id="size" class="form-select" required>
                <option value="P">{{ __('Pequeña') }}</option>
                <option value="M">{{ __('Mediana') }}</option>
                <option value="G">{{ __('Grande') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ __('Crear Sala') }}</button>
    </form>
</div>
@endsection