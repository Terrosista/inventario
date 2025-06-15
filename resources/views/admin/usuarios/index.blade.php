<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Usuarios y Roles</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded-lg">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-4 text-green-600 font-bold animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filtros --}}
            <form method="GET" action="{{ route('admin.usuarios.index') }}" class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nombre, correo o cédula"
                           class="w-full sm:w-64 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-emerald-300">

                    <select name="role" class="w-full sm:w-52 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-emerald-300">
                        <option value="">Todos los roles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition shadow">
                        Filtrar
                    </button>

                    <a href="{{ route('admin.usuarios.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition shadow">
                        Limpiar
                    </a>
                </div>
            </form>

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr> 
                            <th class="px-4 py-2">Cédula</th>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Correo</th>
                            <th class="px-4 py-2 text-left">Rol</th>
                            <th class="px-4 py-2 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $user)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="px-4 py-2">{{ $user->cedula }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->getRoleNames()->join(', ') ?: 'Sin rol' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('admin.usuarios.edit', $user) }}"
                                       class="inline-block px-3 py-1 text-sm bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">
                                        Editar Rol
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No hay usuarios que coincidan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
