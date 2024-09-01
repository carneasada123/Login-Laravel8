<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar las entradas del usuario
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required',
        ]);

        $credentials = $request->only('correo', 'clave');

        // Añadir esta línea para imprimir la consulta SQL generada
        \DB::listen(function ($query) {
            \Log::info($query->sql);
            \Log::info($query->bindings);
        });

        // Intentar autenticar con 'correo' y 'password' (Laravel espera 'password' por defecto)
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['clave']])) {
            $user = Auth::user();
            return response()->json([
                'correo' => $user->correo,
                'nombre' => $user->nombre,
            ], 200);
        }

        // Si falla la autenticación, retornar un error
        return response()->json([
            'error' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out.']);
    }
}
