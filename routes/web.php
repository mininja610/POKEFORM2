<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyController; 

use App\Models\Party;
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
Route::get('/micro', function () {
    return view('parties/micro');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/bootstrap', function () {
    return view('bootstrap');
});

Route::get('/dashboard', function () {
    $id = Auth::user ()->id;
        $parties = Party::where('user_id',$id)->get();
    
    return view('parties/party')->with(['parties' => $parties]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PartyController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/parties/create', 'create')->name('party.create');
    Route::post('/parties/', 'store')->name('party.store');
    Route::get('/parties/', 'party')->name('party');
    Route::post('/parties/{party}/select', 'select')->name('party.select');
    Route::get('/parties/{party}/edit', 'edit')->name('party.edit');
    Route::put('/parties/{party}','update')->name('party.update');
    Route::get('/parties/{party}', 'show')->name('party.show');
    Route::delete('/parties/{party}', 'delete')->name('party.delete');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
