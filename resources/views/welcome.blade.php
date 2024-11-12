{{-- resources/views/welcome.blade.php --}}

@if(Auth::check())
<script>
    window.location.href = "{{ route('dashboard') }}"; // Redirige a dashboard si el usuario está autenticado
</script>
@endif

<!-- Si el usuario no está autenticado -->
<div class="container py-5" style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef);">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-5">
                    <h2 class="card-title text-center text-primary mb-4">
                        <i class="bi bi-house-door-fill"></i> Bienvenido a AlCe-Cowork
                    </h2>
                    <p class="text-center text-muted mb-4">Inicia sesión o regístrate para continuar.</p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-success">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>