<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articulos = Articulo::all();
        return response()->json($articulos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Description' => 'required|string|max:500',
            'unidad' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $articulo = Articulo::create($validatedData);

        return response()->json([
            'message' => 'Artículo agregado exitosamente',
            'articulo' => $articulo
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $articulo = Articulo::findOrFail($id);
        return response()->json($articulo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Description' => 'required|string|max:500',
            'unidad' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        // Encontrar el artículo por su ID
        $articulo = Articulo::findOrFail($id);

        // Actualizar el artículo con los datos validados
        $articulo->update($validatedData);

        // Devolver la respuesta JSON
        return response()->json([
            'message' => 'Registro actualizado satisfactoriamente',
            'articulo' => $articulo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Articulo::destroy($id);
        return response()->json([
            'message' => 'Artículo eliminado exitosamente'
        ], 200);
    }
}
