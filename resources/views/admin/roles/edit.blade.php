{{-- filepath: resources/views/admin/roles/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Rol
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('roles.update', $role) }}">
                    @csrf
                    @if(isset($role))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre del rol</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                               value="{{ old('name', $role->name) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Permisos</label>
                        <div class="mt-2 space-y-2">
                            @foreach($permissions as $permission)
                                <div class="flex items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                           {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                           class="form-checkbox">
                                    <span class="ml-2">{{ $permission->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('roles.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg shadow">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-lg shadow">
                            Guardar
                        </button>
                    </div>
              </form>
            </div>
        </div>
    </div>
</x-app-layout>
