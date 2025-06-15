<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Panel de Administrador</h2>
    </x-slot>

    @role('admin')
        <div class="p-4">
            <p>Bienvenido, administrador.</p>
        </div>  
        @endrole


    <div class="p-4">
        <p>Bienvenido, administrador.</p>
    </div>
</x-app-layout>
