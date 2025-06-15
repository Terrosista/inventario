<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'cedula'  => ['required','string','max:20','unique:users,cedula'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'cedula' => $request->cedula, // Asegúrate de que este campo exista en tu base de datos
        'password' => Hash::make($request->password),
    ]);

    // Asignar rol automáticamente
    $user->assignRole('empleado');

    event(new Registered($user));

    Auth::login($user); // Iniciar sesión inmediatamente

    // Redirigir según el rol
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('empleado')) {
        return redirect()->route('empleado.dashboard');
    } elseif ($user->hasRole('auditor')) {
        return redirect()->route('auditor.dashboard');
    }

    // Fallback en caso de que no tenga ningún rol
    return redirect('/login')->with('error', 'No tienes acceso a esta aplicación. Por favor, contacta al administrador.');
}

}
