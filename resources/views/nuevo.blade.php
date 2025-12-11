@extends('plantillas.base')
@section('titulo')
    nuevo
@endsection
@section('cabecera')
    Crear Artículo
@endsection
@section('contenido')
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <form class="space-y-4" method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- NOMBRE -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-tag mr-1"></i> Nombre
                </label>
                <input type="text" id="nombre" name="nombre" value="{{ @old('nombre') }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Nombre del artículo">
                <x-pintarerror nomError="nombre" />
            </div>

            <!-- DESCRIPCIÓN -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-align-left mr-1"></i> Descripción
                </label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Descripción del artículo">{{@old('descripcion')}}</textarea>
                <x-pintarerror nomError="descripcion" />
            </div>

            <!-- DISPONIBLE -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-check-circle mr-1"></i> Disponible
                </span>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 text-gray-700">
                        <input type="radio" name="disponible" value="Si" class="text-blue-600 focus:ring-blue-500" @checked(@old('disponible')=='Si') />
                        <span>Si</span>
                    </label>

                    <label class="flex items-center gap-2 text-gray-700">
                        <input type="radio" name="disponible" value="No" class="text-blue-600 focus:ring-blue-500"  @checked(@old('disponible')=='No') />
                        <span>No</span>
                    </label>
                </div>
                <x-pintarerror nomError="disponible" />
            </div>
            <!-- IMAGEN -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-image mr-1"></i> Imagen
                </span>
            </div>
            <div class="p-1 rounded bg-green-100 relative w-full h-82 border-2 border-black">
                <input type="file" class="hidden" accept="image/*" name='imagen' id='cimagen'
                    oninput="preview.src=window.URL.createObjectURL(this.files[0])" />
                <label for="cimagen" class="absolute right-2 bottom-2 text-white italic p-2 rounded-xl bg-black">
                    <i class="fas fa-upload mr-2"></i>GUARDAR
                </label>
                <img src="" class="w-full h-full bg-center bg-cover bg-no-repeat" id="preview" />
            </div>
            <x-pintarerror nomError="imagen" />

            <!-- BOTONES -->
            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('articles.index') }}"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                    <i class="fas fa-times"></i> Cancelar
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center gap-2">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
