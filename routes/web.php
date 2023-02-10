<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RecipeController;

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

Route::get('/docs', function () {
    return view('swagger.index');
});

Route::match(['get', 'post'], '/', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');

Route::prefix('/admin')->group(function () {
    Route::group(['middleware'=>['auth']],function(){
        Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'dashboard']);
         //category
        Route::get('/category', [CategoryController::class, 'allCategory']);
        Route::get('/add-category', [CategoryController::class, 'addCategory']);
        Route::get('/edit-category/{category?}', [CategoryController::class, 'editCategory']);
        Route::post('/add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        Route::get('/show-category-details/{id}', [CategoryController::class, 'showCategoryDetails']);
        Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

        //recipe
        Route::get('/recipe', [RecipeController::class, 'allRecipe'])->name('admin.recipes');
        Route::post('/allrecipedataTable', [RecipeController::class, 'allrecipedataTable'])->name('admin.allrecipedataTable');
        Route::get('/edit-recipe/{recipe}', [RecipeController::class, 'editRecipeView'])->name('edit-recipe');
        Route::post('/edit-recipe/{recipe}', [RecipeController::class, 'editRecipe']);
        Route::get('/show-recipe/{recipe}', [RecipeController::class, 'showRecipe'])->name('show-recipe');
        Route::get('/delete-recipe/{id}', [RecipeController::class, 'deleteRecipe'])->name('delete-recipe');


    });
});
