<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});


// Book Routes
Route::controller(BookController::class)->prefix('books')->group(function () {
    Route::get('/', 'index')->name('books.index');

    Route::get('/create', 'create')->name('books.create');

    Route::post('/store', 'store')->name('books.store');

    Route::delete('/destroy/{id}', 'destroy')->name('books.destroy');

    Route::get('/edit/{id}', 'edit')->name('books.edit');

    Route::put('/update/{id}', 'update')->name('books.update');
});