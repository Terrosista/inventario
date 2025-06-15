<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Permisos
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
            <form method="GET" action="{{ route('permisos.index') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Buscar permiso...">

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Buscar
                </button>
            </form>

          <form action="{{ route('permisos.create') }}" method="GET">
    <button type="submit"
        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2 rounded-md shadow-md transition">
        + Crear Permiso
    </button>
</form>


        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 dark:bg-green-700 dark:text-white rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Nombre
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($permisos as $permiso)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $permiso->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex space-x-4">
                                    <a href="{{ route('permisos.edit', $permiso) }}"
                                       class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                        Editar
                                    </a>

                                    <form action="{{ route('permisos.destroy', $permiso) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este permiso?');">
                      
                                          @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 dark:text-red-400 font-medium hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                    No hay permisos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4 px-6">
                    {{ $permisos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
