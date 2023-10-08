<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//   return view('welcome');
// });

Route::get('/', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'all']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{product}', [ProductController::class, 'show']);
Route::put('/product/{product}', [ProductController::class, 'update']);
Route::delete('/product/{product}', [ProductController::class, 'destroy']);


Route::get('/storage/app/images/{filename}', function ($filename) {
  $path = storage_path('app/images/' . $filename);
  if (!file_exists($path)) {
    abort(404);
  }
  return Response::file($path);
})->where('filename', '.*');

// Route::resource('/products', ProductController::class);