<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BasePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

Route::get('/', [BasePageController::class, 'admin'])
    ->middleware('admin')
    ->name('admin');

Route::resources([
    'pages' => PageController::class,
    'categories' => CategoryController::class,
    'products' => ProductController::class
]);
