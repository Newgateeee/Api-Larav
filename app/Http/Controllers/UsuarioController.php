<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarios;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $usuarios = Usuarios::all();
        return response()->json($usuarios, 200);
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
            'usuario' => 'required|string|max:255',
            'pass' => 'required|string|max:100',
        ]);

        $validatedData['pass'] = Hash::make($validatedData['pass']);
        $usuarios = Usuarios::create($validatedData);

        return response()->json([
            'message' => 'Usuario agregado exitosamente',
            'usuario' => $usuarios
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
        $usuarios = Usuarios::findOrFail($id);
        return response()->json($usuarios, 200);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'usuario' => 'required|string|max:255',
            'pass' => 'required|string|max:100',
        ]);

        $validatedData['pass'] = Hash::make($validatedData['pass']);
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->update($validatedData);

        return response()->json([
            'message' => 'Registro actualizado satisfactoriamente',
            'usuario' => $usuarios
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
        Usuarios::destroy($id);
        return response()->json([
            'message' => 'Usuario eliminado exitosamente'
        ], 200);
    }

    /**
     * Login a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required|string',
            'pass' => 'required|string',
        ]);

        $user = Usuarios::where('usuario', $credentials['usuario'])->first();

        if (!$user || !Hash::check($credentials['pass'], $user->pass)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401)->header('WWW-Authenticate', 'Bearer');
        }

        // Generar token de acceso, por ejemplo usando Laravel Passport o JWT
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'user' => $user
        ], 200);
    }

}
