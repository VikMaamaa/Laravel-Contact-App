<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\ProfileController;
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

Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
//     Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');

// Route::get('/contacts/{contact:first_name}', [ContactController::class, 'show'])->name('contacts.show');

// Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');

// Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::resource('/contacts', ContactController::class);
 //  ->only(['create', 'store', 'edit', 'update', 'destroy']);
 Route::resource('/companies', CompanyController::class);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings/account', [AccountController::class, 'index']);

Route::get('/settings/profile', [ProfileController::class, 'edit'])->name('settings.profile.edit');

Route::put('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');


});

// Route::resource([
//     '/companies' =>  CompanyController::class,
//     '/contacts' => ContactController::class,

// ]);


// Route::resource('/contacts', ContactController::class)->parameters([
//     'contacts' => 'kontak'
// ]);

// Route::resource('/contacts', ContactController::class)->names([
//     'index' => 'contacts.all',
//     'show' =>  'contacts.view'
// ]);

// Route::resource('/companies.contacts', ContactController::class);



Auth::routes(['verify' => true]);


