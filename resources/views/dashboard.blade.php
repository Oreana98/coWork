<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido a AlCe-Cowork') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-20">
        @if(Auth::check() && Auth::user()->id_rol == 1)
        <!-- Opciones para Administradores -->
        <div class="mt-4">
            <a href="{{ route('rooms.index') }}" class="btn btn-primary">
                {{ __('Gestionar Salas') }}
            </a>
        </div>
        <div class="mt-4">
            <a href="{{ route('reservations.index') }}" class="btn btn-primary">
                {{ __('Gestionar Reservas') }}
            </a>
        </div>
        @endif

        @if(Auth::check() && Auth::user()->id_rol == 2)
        <!-- Opciones para Usuarios con Rol 2 -->
        <div class="mt-4">
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                {{ __('Realizar Reservación') }}
            </a>
        </div>
        <div class="mt-4">
            <a href="{{ route('reservations.index', ['user_id' => Auth::id()]) }}" class="btn btn-primary">
                {{ __('Visualizar mis Reservaciones') }}
            </a>
        </div>
        @endif
    </div>
    @endsection
</x-app-layout>