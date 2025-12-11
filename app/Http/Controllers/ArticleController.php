<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos=Article::orderBy('id', 'desc')->paginate(5);
        return view('inicio', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos=$request->validate(self::validaciones());
        // guardamos el registro pero antes tengo que comprobar si he subido o no una imagen y guardarla
        $datos['imagen']=$request->imagen?->store('imagenes/articles/') ?? 'imagenes/articles/noimage.jpg';
        Article::create($datos);
        return redirect()->route('articles.index')->with('mensaje', 'Articulo Guardado');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('editar', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $datos=$request->validate(self::validaciones($article->id));
        $datos['imagen']=$request->imagen?->store('imagenes/articles') ?? $article->imagen;
        //Se hemos subido una imagen nueva borraremos la anterior
        //solo si la antigua NO es "noimage.jpg"
        if($request->imagen && basename($article->imagen)!='noimage.jpg'){
            Storage::delete($article->imagen);
        }
        $article->update($datos);
        
        return redirect()->route('articles.index')->with('mensaje', 'Articulo Editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if(basename($article->imagen)!='noimage.jpg'){
            Storage::delete($article->imagen);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('mensaje', 'Articulo Eliminado');
    }

    private static function validaciones(?int $id=null): array{
        return [
            'nombre'=>['required', 'string', 'min:3', 'max:200', 'unique:articles,nombre,'.$id],
            'descripcion'=>['required', 'string', 'min:15', 'max:500'],
            'disponible'=>['required', 'in:Si,No'],
            'imagen'=>['nullable', 'image', 'max:2040'],
        ];
    }

    public function updateRapido(Article $article){
        $disponible=$article->disponible=='Si' ? 'No' : 'Si';
        $article->update([
            'disponible'=>$disponible
        ]);
        return redirect()->route('articles.index');
    }
}
