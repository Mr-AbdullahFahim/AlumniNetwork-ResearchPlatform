<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content ml-64 p-8">
        <div class="dashboard-header mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Manage Users</h2>
        </div>

        <!-- Filter Users by Role -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.users') }}">
                <label for="role" class="block text-sm font-medium text-gray-700">Filter by Role:</label>
                <select name="role" id="role" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-gray-500 focus:ring-gray-500" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request()->get('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="alumni" {{ request()->get('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="student" {{ request()->get('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="lecturer" {{ request()->get('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                </select>
            </form>
        </div>

        <!-- Display Users -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Name</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Email</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Role</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Status</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Actions</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-500">Promote</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $user->name ?? 'Guest' }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $user->role }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ ucfirst($user->status) }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 space-x-2">
                                @if($user->status == 'pending')
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none" onclick="return confirm('Are you sure you want to approve this user?')">Approve</button>
                                    </form>
                                @endif

                                @if(in_array($user->status, ['rejected', 'denied']))
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none" onclick="return confirm('Are you sure you want to readmit this user?')">Readmit</button>
                                    </form>
                                @endif

                                @if($user->status == 'approved')
                                    <form action="{{ route('admin.users.remove', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none" onclick="return confirm('Are you sure you want to remove this user? This will change the status to rejected.')">Remove</button>
                                    </form>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-900 space-x-2">
                            @if($user->status == 'approved' && $user->role !== 'admin')
                                <!-- Promote to Admin button -->
                                <form action="{{ route('admin.users.promote', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none" onclick="return confirm('Are you sure you want to promote this user to admin?')">Promote to Admin</button>
                                </form>
                            @endif

                            @if($user->role === 'admin' && $user->previous_role)
                                <!-- Depromote from Admin button -->
                                <form action="{{ route('admin.users.depromote', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none" onclick="return confirm('Are you sure you want to depromote this admin to their previous role?')">Depromote</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tailwind JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>
