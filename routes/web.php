<?php

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

/*
use App\Models\Product;

Route::get('/', function(){
    $products = Product::all();
    foreach($products as $product){
        echo $product->name.'<br>';
}
    die();
    return view('welcome');
});
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource(name:'products', controller:'\App\Http\Controllers\ProductController');
//Route::resource(name:'comments', controller:'\App\Http\Controllers\CommentController');

Route::get('/delete-product/{product_id}', array(
    'as' => 'delete-product',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProductController@delete_product'
));

