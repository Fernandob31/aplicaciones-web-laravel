<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rutas de invitado (para loguearse)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
});

// Rutas protegidas (solo para usuarios que ya iniciaron sesión)
Route::middleware('auth')->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
// Cambiamos el retorno de texto por la vista que creaste
Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

// 1. Ruta para mostrar un formulario HTML básico
Route::get('/test-cloudinary', function () {
    return '
        <h2>Prueba de Cloudinary</h2>
        <form action="/test-cloudinary" method="POST" enctype="multipart/form-data">
            '.csrf_field().'
            <input type="file" name="imagen" accept="image/*" required>
            <br><br>
            <button type="submit">Subir Imagen</button>
        </form>
    ';
});

// 2. Ruta para procesar la subida
Route::post('/test-cloudinary', function (Request $request) {
    try {
        // Inicializamos Cloudinary con tu variable de entorno
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

        // Subimos el archivo a una carpeta llamada "pruebas"
        $resultado = $cloudinary->uploadApi()->upload(
            $request->file('imagen')->getRealPath(),
            ['folder' => 'pruebas']
        );

        // Si todo sale bien, mostramos el link de la imagen subida
        $url = $resultado['secure_url'];
        return "¡Subida exitosa! <br><br> Puedes ver tu imagen aquí: <a href='{$url}' target='_blank'>{$url}</a>";

    } catch (\Exception $e) {
        return "Hubo un error al subir: " . $e->getMessage();
    }
});