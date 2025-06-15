<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class PermisoUsuarioController extends Controller
{
 public function index(Request $request)
{
    $query = User::query();

    if ($request->filled('search')) {
        $q = $request->search;
        $query->where(function($sub) use ($q) {
            $sub->where('name', 'like', "%{$q}%")
                ->orWhere('email','like', "%{$q}%")
                ->orWhere('cedula','like', "%{$q}%");
        });
    }

    if ($request->filled('role')) {
        $query->whereHas('roles', fn($r) => $r->where('name', $request->role));
    }

    $usuarios = $query->paginate(10)->withQueryString();
    $roles    = \Spatie\Permission\Models\Role::all();

    return view('admin.usuarios.index', compact('usuarios','roles'));
}



    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.usuarios.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|exists:roles,name',
    ]);

    $user->syncRoles([$request->role]); // Usa el nombre directamente

    return redirect()->route('admin.usuarios.index')->with('success', 'Rol actualizado correctamente.');
}

}
