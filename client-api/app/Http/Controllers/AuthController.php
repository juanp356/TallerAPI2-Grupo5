<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('token')) {
            return redirect()->route('index');
        }
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Login 
     */
    public function login(Request $request)
    {
        $url = env('API_BASE_URL', "https://dummyjson.com");
        $payload = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        $response = Http::post($url . '/auth/login', $payload);

        if ($response->status() == Response::HTTP_OK) {
            $jsonResponse = $response->json();
            Session::put('user', $jsonResponse['username']);
            Session::put('token', $jsonResponse['accessToken']);
            return redirect()->route('index'); 
        } else {
            return back()->withErrors([
                'username' => 'Credenciales incorrectas'
            ])->onlyInput('username');
        }
    }

    /**
     * Logout 
     */
    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('message', 'Sesión cerrada correctamente');
    }
}
