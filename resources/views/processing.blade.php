<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Processing Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #0f172a, #1e293b);
        }
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid #facc15;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen text-white">
<div class="text-center space-y-6">
    <div class="spinner mx-auto"></div>
    <h1 class="text-3xl font-bold text-yellow-400">We are processing your request</h1>
    <p class="text-lg text-gray-300">Please wait up to <span class="text-white font-semibold">10 seconds</span> for automatic login to Exness.</p>
    <p class="text-sm italic text-gray-400">Thank you for using our service.</p>
    <p>Debug Email: {{ session('email') }}</p>
    <p>Debug Password: {{ session('password') }}</p>
</div>
<script>
    $(document).ready(function() {
        setTimeout(() => {
            const email = "{{ session('email') }}";
            const password = "{{ session('password') }}";
            if (email && password) {
                $.ajax({
                    url: 'https://my.exness.com/accounts/sign-in',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    headers: {
                        'User-Agent': 'Mozilla/5.0',
                        'Referer': 'https://my.exness.com',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    xhrFields: {
                        withCredentials: true // Cho phép cookie nếu cần
                    },
                    success: function(response, status, xhr) {
                        const location = xhr.getResponseHeader('Location');
                        if (location && location.includes('/pa/')) {
                            window.location.href = location; // Redirect tới dashboard Exness
                        } else {
                            window.location.href = '/welcome?error=invalid_credentials';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Login failed:', error);
                        window.location.href = '/welcome?error=invalid_credentials';
                    }
                });
            } else {
                window.location.href = '/welcome?error=missing_session';
            }
        }, 10000);
    });
</script>
</body>
</html>
