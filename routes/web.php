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

Route::get("/vin", function(){
    return "Halo Kevin";
});

Route::redirect("/tech", "/vin");

Route::fallback(function(){
    return "404 by Kevin Chang";
});

Route::view("/hello", "hello", ["name" => "Kevin"]);
Route::get("/hello-again", function(){
   return view("hello", ["name" => "Kevin Chang"]);
});

Route::get("/hello-world", function(){
   return view("hello.world", ["name" => "Kevin"]);
});

Route::get("/products/{id}", function($productId){
    return "Product $productId";
})->name("product.detail");

Route::get("/products/{product}/items/{item}", function($productId, $itemId){
    return "Product $productId, item $itemId";
})->name("product.item.detail");

Route::get("/categories/{id}", function($id){
    return "Category: $id";
})->where('id', '[0-9]+')->name("category.detail");

Route::get("/users/{userId?}", function($userId = "404"){
    return "User: $userId";
})->name("user.detail");

Route::get("/conflict/kevin", function(){
    return "Conflict: Kevin Chang";
});

Route::get("/conflict/{name}", function($name){
   return "Conflict: $name";
});

Route::get("/product-expand/{id}", function($id){
    $link = route("product.detail", ["id" => $id]);
    return "Link: $link";
});

Route::get("/product-expand-redirect/{id}", function($id){
    return redirect()->route("product.detail", ["id" => $id]);
});


