<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex">
        <div class="w-1/5 bg-gray-800 h-screen text-white p-6">
            <div class="text-center mb-6">
                <img src="https://via.placeholder.com/80" class="rounded-full mx-auto mb-3" alt="Admin Photo">
                <h4 class="text-xl font-semibold">Admin</h4>
            </div>
            <hr class="border-gray-600 mb-6">
            <a href="{{ route('admin.home') }}" class="block py-2 px-4 hover:bg-gray-700 rounded {{ Request::is('admin/home') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="{{ route('admin.users') }}" class="block py-2 px-4 hover:bg-gray-700 rounded {{ Request::is('admin/users') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="{{ route('admin.approvals') }}" class="block py-2 px-4 hover:bg-gray-700 rounded {{ Request::is('admin/approvals') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-tasks"></i> Approvals
            </a>
            <a href="{{ route('admin.reports') }}" class="block py-2 px-4 hover:bg-gray-700 rounded {{ Request::is('admin/reports') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <a href="{{ route('admin.settings') }}" class="block py-2 px-4 hover:bg-gray-700 rounded {{ Request::is('admin/settings') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="{{ route('admin.logout') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <!-- Main Content -->
        <div class="w-4/5 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
                <div class="flex space-x-4 items-center">
                    <!-- Notification Button -->
                    <a href="{{ route('admin.notifications') }}" title="Notifications" class="relative">
                        <i class="fas fa-bell fa-lg text-gray-700"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs px-2">{{ $pendingRequestsCount }}</span>
                    </a>
                    <!-- Email/Inbox Button -->
                    <a href="{{ route('admin.inbox') }}" title="Inbox">
                        <i class="fas fa-envelope fa-lg text-gray-700"></i>
                    </a>
                    <!-- Admin Profile Dropdown -->
                    <div class="relative">
                        <button class="text-gray-700 focus:outline-none" id="profileDropdown" aria-haspopup="true">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </button>
                        <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Profile</a>
                            <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="{{ route('admin.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-2xl">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold">Approved Users</h3>
                    <p class="text-2xl">{{ $approvedUsers }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold">Pending Requests</h3>
                    <p class="text-2xl">{{ $pendingRequestsCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold">Denied Requests</h3>
                    <p class="text-2xl">{{ $deniedRequests }}</p>
                </div>
            </div>

            <!-- Pending Requests Section -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h4 class="text-xl font-semibold mb-4">Pending User Requests</h4>
                <table class="min-w-full table-auto text-center">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="px-6 py-3">User Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($pendingRequests as $request)
                            <tr class="border-b">
                                <td class="px-6 py-3 align-middle">{{ $request->name }}</td>
                                <td class="px-6 py-3 align-middle">{{ $request->email }}</td>
                                <td class="px-6 py-3 align-middle">{{ $request->type }}</td>
                                <td class="px-6 py-3 flex justify-center space-x-2 align-middle">
                                    <form method="POST" action="{{ route('admin.approve', $request->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.deny', $request->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Deny</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-white text-center py-4 mt-6">
        <p>&copy; 2024 Research and Alumni Dashboard</p>
    </div>

    <!-- FontAwesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- Tailwind JS for Dropdown -->
    <script>
        document.getElementById('profileDropdown').addEventListener('click', function () {
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>