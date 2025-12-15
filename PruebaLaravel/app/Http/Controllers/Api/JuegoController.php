<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Juego;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //GET
    public function index(Request $request)
    {
        $query = Juego::with(['plataforma','generos'])-> where('activo', true);//llama al modelo juego con relaciones plataformas y generos y filtra por activo = true
       
        if ($request ->has('buscar')) {
            $termino = $request->input('buscar');
            $query->where('titulo', 'like', '%' . $termino . '%'); //filtro por titulo que contenga el termino de busqueda
        }
        $juegos = $query->orderBy('created_at', 'desc')->get(); //ordena por fecha de creacion descendente y ordena los resultado 
       
        return response()->json([
            'success' => true, 
            'cantidad' => $juegos->count(),
            'data' => $juegos
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    //POST
    public function store(Request $request)
    {
        $validate = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion_corta' => 'nullable|string',
            'descripcion_larga' => 'nullable|string',
            'precio_normal' => 'required|numeric',
            'precio_oferta' => 'nullable|numeric|lt:precio_normal',
            'imagen_url' => 'nullable|string|url',
            'destacado' => 'boolean',
            'activo' => 'boolean',
            'plataforma_id' => 'required|exists:plataformas,id',//Validar la FK
            'generos' => 'array', //Validar generos como array
            'generos.*' => 'exists:generos,id' //Validar cada genero
        ]);

        $data = $request->all();
        
        $juego = Juego::create($data);//Crear el juego con los datos validados

        if ($request->has('generos')) {
            $juego->generos()->sync($request->input('generos'));//Sincroniza generos en la tabla pivote 
        }
        return response()->json([
            'success' => true,
            'message' => 'Juego creado exitosamente',
            'data' => $juego -> load('generos')//Cargar la relacion generos
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    //GET -> ID
    public function show(string $id)
    {
        $juego = Juego::with(['plataforma','generos'])->find($id);//Buscar juego por ID con relaciones plataforma y generos

        if (!$juego) {
            return response()->json([
                'success' => false,
                'message' => 'Juego no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $juego
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    //PUT -> ID
    public function update(Request $request, string $id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'success' => false,
                'message' => 'Juego no encontrado'
            ], 404);
        }

        $request -> validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion_corta' => 'nullable|string',
            'descripcion_larga' => 'nullable|string',
            'precio_normal' => 'sometimes|numeric',
            'precio_oferta' => 'nullable|numeric|lt:precio_normal',
            'imagen_url' => 'sometimes|nullable|string|url',
            'destacado' => 'sometimes|boolean',
            'activo' => 'sometimes|boolean',
            'plataforma_id' => 'sometimes|required|exists:plataformas,id',
            'generos' => 'sometimes|array', 
            'generos.*' => 'exists:generos,id' 
        ]);//Validacion de los campos a actualizar

        // Manejo de imagen con Firebase
            $data = $request->all();

        if ($request->hasFile('imagen')) {
            $url = $this->firebaseService->uploadImage($request->file('imagen'), 'juegos');
            $data['imagen_url'] = $url; // Guarda la URL pública en el campo imagen_url
        }


        $juego->update($request->all());//Actualizar el juego con los datos validados

        if ($request->has('generos')) {
            $juego->generos()->sync($request->input('generos'));//Sincroniza generos en la tabla pivote 
        }

        return response()->json([
            'success' => true,
            'message' => 'Juego actualizado exitosamente',
            'data' => $juego -> load('generos')//Cargar la relacion generos
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //DELETE -> ID
    public function destroy(string $id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'success' => false,
                'message' => 'Juego no encontrado'
            ], 404);
        }

        $juego->delete();

        return response()->json([
            'success' => true,
            'message' => 'Juego eliminado exitosamente'
        ], 200);
    }
}
