<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
 public function index(Request $request)
{
    $search = $request->input('search');

    $permisos = Permission::when($search, function ($query, $search) {
        return $query->where('name' ,'like', '%' . $search . '%');
    })
    ->orderBy('name')
    ->paginate(10)
    ->withQueryString();

    return view('permisos.index', compact('permisos', 'search'));
}



    public function create()
    {
        return view('permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $request->name]);
        return redirect()->route('permisos.index')->with('success', 'Permiso creado.');
    }

    public function edit(Permission $permiso)
    {
        return view('permisos.edit', compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $request->validate(['name' => 'required|unique:permissions,name,' . $permiso->id]);
        $permiso->update(['name' => $request->name]);
        
        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado.');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado.');
    }
}


