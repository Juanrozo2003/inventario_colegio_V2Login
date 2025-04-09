@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="container">
    <div class="login container">
        <h1 class="login-title">INICIA SESIÓN</h1>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Iniciar sesión</h5>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Usuario</label>
                        <input id="email" type="email" class="form-control border-0 border-bottom rounded-0 @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus required autocomplete="email"  autofocus
                        style="box-shadow: none !important;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control border-0 border-bottom rounded-0 @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password"
                               style="box-shadow: none !important;">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                     <!-- rol -->
                     <div class="form-group mt-3">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror" required>
                            <option value="">-- Selecciona tu rol --</option>
                            <option value="estudiante" {{ old('rol') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                            <option value="docente" {{ old('rol') == 'docente' ? 'selected' : '' }}>Docente</option>
                            <option value="secretaria" {{ old('rol') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                            <option value="rectora" {{ old('rol') == 'rectora' ? 'selected' : '' }}>Rectora</option>
                        </select>

                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    

                    <!-- Enlace "Olvidé contraseña" -->
                <div class="mb-4 text-end">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                        ¿HAS OLVIDADO LA CONTRASEÑA?
                    </a>
                </div>

                <!-- Botón de envío -->
                <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>

                    <!-- Recordar sesión -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Recordar sesión</label>
                    </div>

                    

                      <!-- Línea divisora -->
                <hr class="my-4">

                <!-- Footer -->
                <div class="text-center mt-4">
                    <p class="mb-1"><strong>2025 COLEGIO Travesuras</strong></p>
                    <p class="small">ALL RIGHTS RESERVED.</p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection