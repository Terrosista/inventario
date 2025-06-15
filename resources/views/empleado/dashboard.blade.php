<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Panel de </h2>
    </x-slot>
    @role('empleado')
        <div class="p-4">
            <p>Bienvenido, administrador.</p>
        </div>  
        @endrole

    <div class="p-4">
        <p>Bienvenido, administrador.</p>
    </div>
</x-app-layout>
