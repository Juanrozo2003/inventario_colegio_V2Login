<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    /**
     * Validar credenciales personalizadas incluyendo el rol.
     */
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'rol' => $request->get('rol'), // validación por rol
        ];
    }

    public function login(Request $request)
{
    $this->validateLogin($request);

    // Si se exceden los intentos, bloquear
    if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);

        return $this->sendLockoutResponse($request);
    }

    // Intentar login con email, password y rol
    if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    // Incrementar intentos fallidos
    $this->incrementLoginAttempts($request);

    return back()->withErrors([
        'email' => __('Estas credenciales no coinciden con nuestros registros.'),
    ])->onlyInput('email', 'rol');
}


    /**
     * Redirección personalizada según el rol del usuario.
     */
    protected function redirectTo()
    {
        $rol = Auth::user()->rol;

        switch ($rol) {
            case 'estudiante':
                return route('dashboard.estudiante');
            case 'docente':
                return route('dashboard.docente');
            case 'secretaria':
                return route('dashboard.secretaria');
            case 'rectora':
                return route('dashboard.rectora');
            default:
                return '/login'; // fallback
        }
    }
}
