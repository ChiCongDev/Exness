<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Processing Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
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
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen text-white">
<div class="text-center space-y-6">
    <div class="spinner mx-auto"></div>
    <h1 class="text-3xl font-bold text-yellow-400">We are processing your request</h1>
    <p class="text-lg text-gray-300">Please wait up to <span class="text-white font-semibold">24 hours</span> for completion.</p>
    <p class="text-sm italic text-gray-400">Thank you for using our service.</p>
</div>

<!-- ✅ Redirect sau 5 giây -->
<script>
    setTimeout(function () {
        window.location.href = "https://www.exness.com/";
    }, 5000);
</script>

</body>
</html>
