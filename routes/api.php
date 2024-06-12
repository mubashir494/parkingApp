<?php

use App\Http\Controllers\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/spot/{id}/park',[Parking::class,'park'])->name('park');
Route::post('/spot/{id}/unpark',[Parking::class,'unpark'])->name('unpark');
Route::get('/spot/list',[Parking::class,'getAllParking'])->name('getAllParking');