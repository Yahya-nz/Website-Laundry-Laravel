<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\GoogleController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tanpa Login)
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome_laundry');
})->name('home');

// Info Pages
Route::get('/profil-usaha', function () {
    return view('profil');
})->name('profil');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/harga', function () {
    return view('harga');
})->name('harga');

// Tracking Order (Public - bisa tanpa login)
Route::get('/tracking/{id}', [OrderController::class, 'tracking'])->name('orders.tracking');

/*
|--------------------------------------------------------------------------
| GOOGLE OAUTH
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| REDIRECT AFTER LOGIN (Role-based)
|--------------------------------------------------------------------------
*/

Route::get('/redirect', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    // Admin & Staff ke dashboard admin
    if ($user->role === 'admin' || $user->role === 'staff') {
        return redirect('/admin/dashboard');
    }

    // User biasa ke dashboard user
    return redirect('/dashboard');
})->middleware('auth')->name('redirect');

/*
|--------------------------------------------------------------------------
| USER ROUTES (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard User
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Wallet User
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/topup', [WalletController::class, 'topupForm'])->name('wallet.topup.form');
    Route::post('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');

    // Transactions User
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // User bisa lihat order mereka sendiri (optional - jika mau dibuat fitur ini)
    // Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
});

/*
|--------------------------------------------------------------------------
| ADMIN & STAFF ROUTES (Admin/Staff Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Orders Management (CRUD)
    Route::resource('orders', OrderController::class);

    // Notifikasi WhatsApp
    Route::get('/orders/{id}/notify-done', [OrderController::class, 'notifyDone'])->name('orders.notify.done');
    Route::get('/orders/{id}/notify-pickup', [OrderController::class, 'notifyPickup'])->name('orders.notify.pickup');

    // Invoices Management
    Route::resource('invoices', InvoiceController::class);
    Route::post('/invoices/{invoice}/send-whatsapp', [InvoiceController::class, 'sendWhatsApp'])->name('invoices.send-whatsapp');
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');

    // Transactions Admin (approve/reject)
    Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('transactions.index');
    Route::post('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{id}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login, Register, etc.)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
