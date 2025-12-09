@extends('plantillas.base')
@section('titulo')
    Inicio Artículos
@endsection
@section('cabecera')
    Listado de artículos
@endsection
@section('contenido')
    <div class="flex flex-row-reverse mb-2">
        <a href="{{ route('articles.create') }}" class="p-2 bg-blue-500 hover:bg-blue-700 rounded-lg font-bold text-white">
            <i class="fas fa-add mr-2"></i>NUEVO
        </a>
    </div>
    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold">Imagen</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Nombre</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Descripción</th>
                <th class="px-4 py-3 text-center text-sm font-semibold">Disponible</th>
                <th class="px-4 py-3 text-center text-sm font-semibold">Acciones</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach ($articulos as $item)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Imagen -->
                    <td class="px-4 py-3">
                        <img src="{{ Storage::url($item->imagen) }}" alt="imagen articulo"
                            class="w-22 h-22 object-cover rounded-md shadow-sm">
                    </td>

                    <!-- Nombre -->
                    <td class="px-4 py-3">
                        <span class="font-medium text-gray-800">{{ $item->nombre }}</span>
                    </td>

                    <!-- Descripción -->
                    <td class="px-4 py-3 text-gray-600 text-sm">
                        {{ $item->descripcion }}
                    </td>

                    <!-- Disponible -->
                    <td class="px-4 py-3 text-center">
                        <p @class([
                            'p-2 rounded-lg text-center font-bold text-white',
                            'bg-red-500' => $item->disponible == 'No',
                            'bg-green-500' => $item->disponible == 'Si',
                        ])>
                            {{ $item->disponible }}
                        </p>
                    </td>

                    <!-- Acciones -->
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <form action="{{ route('articles.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('articles.edit', $item) }}">
                                <i class="fas fa-edit text-xl mr-2"></i>
                            </a>
                            <button type='submit' onclick="return confirm('¿Borrar Articulo definitivamente?')">
                                <i class="fas fa-trash text-xl"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $articulos->links() }}
    </div>
@endsection
@section('misalertas')
@endsection
