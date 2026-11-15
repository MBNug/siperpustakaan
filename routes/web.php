<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, BookController, AdminController, MemberController, BorrowController};
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('redirect', [HomeController::class, 'redirect']);
Route::get('', [HomeController::class, 'index'])->name('home');
Route::post('/absen', [HomeController::class, 'hadir'])->name('home.hadir');


// Route::get('/event/registration', [EventRegistrationController::class, 'index'])->name('event.registration.index');
// Route::get('/event/registration/{id}/create', [EventRegistrationController::class, 'create'])->name('event.registration.create');
// Route::post('/event/registration', [EventRegistrationController::class, 'store'])->name('event.registration.store');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    // Handle CRUD event
    Route::resource('/book', BookController::class, [
        'except' => ['show'],
        'names' => [
            'index' => 'book',
            'create' => 'book.create',
        ]
    ]);
    Route::get('/book/{id}/delete', [BookController::class, 'delete']) -> name('book.delete');
    
    
    Route::resource('/member', MemberController::class, [
        'names' => [
            'index' => 'member',
            'create' => 'member.create',
            // 'destroy' => 'member.delete'
        ]
    ]);
    Route::get('/member/{id}/delete', [MemberController::class, 'delete']) -> name('member.delete');
    Route::get('/member/{id}/borrow', [MemberController::class, 'lihatpinjaman']) -> name('member.lihatpinjaman');
   

    Route::get('/borrow/export-excel', [BorrowController::class, 'export_excel']);
    Route::resource('/borrow', BorrowController::class, [
        'names' => [
            'index' => 'borrow',
            'create' => 'borrow.create',
            // 'destroy' => 'borrow.delete',
            // 'kembalikan' => 'borrow.kembalikan'
        ]
    ]);
    Route::get('/borrow/{id}/delete', [BorrowController::class, 'delete']) -> name('borrow.delete');
    Route::post('/borrow/{id}/kembalikan', [BorrowController::class, 'kembalikan'])->name('borrow.kembalikan');
    
});
