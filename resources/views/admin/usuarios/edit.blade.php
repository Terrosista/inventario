<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar roles de {{ $user->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-lg">
           <form method="POST" action="{{ route('admin.usuarios.updateRoles', $user) }}">
    @csrf
    @method('PUT')

    <label for="role" class="block mb-2 text-sm font-medium">Rol</label>
    <select name="role" id="role" class="w-full border-gray-300 rounded">
        @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded">Actualizar Rol</button>
</form>
        </div>
    </div>
</x-app-layout>
