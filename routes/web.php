<?php

use App\Http\Controllers\Api\CategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// // get all categories
// Route::get('categories', function() {
//     //
// })->name('categories.index');

// // category create form
// Route::get('categories/create', function() {
//     //
// })->name('categories.create');

// // category store
// Route::post('categories/store', function() {
//     //
// })->name('categories.store');

// // view a single category
// Route::get('categories/{category}', function(Category $category) {

// })->name('categories.show');

// // edit category
// Route::get('categories/{category}/edit', function(Category $category) {

// })->name('categories.edit');



// // update category
// Route::put('categories/{category}', function(Category $category) {

// })->name('categories.update');

// // delete category
// Route::delete('categories/{category}', function(Category $category) {

// })->name('categories.delete');

// Route::resource('categories', CategoryController::class);