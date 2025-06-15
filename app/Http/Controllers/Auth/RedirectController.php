<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

class RedirectController
{
    public static function redirectByRole()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('empleado')) {
            return redirect()->route('empleado.dashboard');
        } elseif ($user->hasRole('auditor')) {
            return redirect()->route('auditor.dashboard');
        }

        return redirect('/login')->with('error', 'No tienes acceso a esta aplicación. Por favor, contacta al administrador.');
    }
}