<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function(){
        Route::get('/', function () {
            return view('welcome');
        });
    Route::get('/all',[CrudController::class,'getAllOffers'])->name('all offers');
    Route::get('/create',[CrudController::class,'create'])->name('offers.create');
    Route::post('/store',[CrudController::class,'store'])->name('offers.store');
    Route::get('/edit/{id}',[CrudController::class,'edit'])->name('offers.edit');
    Route::post('/update{id}',[CrudController::class,'update'])->name('offers.update');
    Route::get('/delete{id}',[CrudController::class,'delete'])->name('offers.delete');

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
