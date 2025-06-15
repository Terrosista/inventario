<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r shadow-md hidden sm:block">
        <div class="h-16 flex items-center justify-center border-b">
            <a href="{{ route('redirect.by.role') }}" class="text-xl font-bold text-green-600">Mi Panel</a>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('redirect.by.role') }}"
               class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-md {{ request()->routeIs('dashboard') ? 'bg-green-50 font-semibold' : '' }}">
                <i data-lucide="home" class="w-5 h-5 me-2"></i>
                <span>Inicio</span>
            </a>
           
            {{-- Agrega más ítems aquí --}}
          



   <!-- resources/views/settings.blade.php -->
<form action="{{ route('settings') }}" method="GET" id="formSettings">
    <select
        name="settings"
        id="settings"
        onchange="document.getElementById('formSettings').submit();"
        class="bg-white border-none focus:ring-0 focus:outline-none"
    >
        <option value="">Configuración</option>
        <option value="{{ route('admin.usuarios.permisos.index') }}">Gestión de Roles</option>
        <option value="{{ route('permisos.index') }}">Gestion Permiso</option>
        <option value="{{ route('roles.index') }}">Crear Roles</option>
    </select>
</form>

 


      

        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm">
    <!-- IZQUIERDA -->
    <div class="sm:hidden">
        <!-- Mobile menu toggle -->
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- CENTRO o NOMBRE -->
    <div>
        <span class="text-gray-700">Hola, {{ Auth::user()->name }}</span>
    </div>

    <!-- DERECHA -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
          <!-- DERECHA   <img src="{{ asset('images/logout-icon.png') }}" alt="Cerrar sesión" class="h-5 w-5">-->
            Cerrar sesión
        </button>
    </form>
</header>


        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>
    </div>
</div>
