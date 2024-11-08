<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

    <!-- Flex Container for Sidebar and Main Content -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-900 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
            <!-- Page Header -->
            <div class="dashboard-header mb-10">
                <h2 class="text-4xl font-extrabold text-white">Manage Users</h2>
            </div>

            <!-- Filter Users by Role -->
            <div class="mb-8">
                <form method="GET" action="{{ route('admin.users') }}" class="space-y-3">
                    <label for="role" class="block text-sm font-medium text-gray-400">Filter by Role:</label>
                    <select name="role" id="role" class="w-full p-3 rounded-md bg-gray-800 text-gray-300 border border-gray-700 focus:border-blue-500 focus:ring-blue-500 focus:ring-2 transition duration-150 ease-in-out" onchange="this.form.submit()">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request()->get('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="alumni" {{ request()->get('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="student" {{ request()->get('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="lecturer" {{ request()->get('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                    </select>
                </form>
            </div>

            <!-- Display Users Table -->
            <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
                <table class="min-w-full table-auto text-gray-200">
                    <thead class="bg-gray-700 text-gray-300 text-sm uppercase">
                        <tr>
                            <th class="py-4 px-6 text-left font-semibold">Name</th>
                            <th class="py-4 px-6 text-left font-semibold">Email</th>
                            <th class="py-4 px-6 text-left font-semibold">Role</th>
                            <th class="py-4 px-6 text-left font-semibold">Status</th>
                            <th class="py-4 px-6 text-left font-semibold">Actions</th>
                            <th class="py-4 px-6 text-left font-semibold">Promote</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 text-sm">{{ $user->name ?? 'Guest' }}</td>
                                <td class="py-4 px-6 text-sm">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-sm capitalize">{{ $user->role }}</td>
                                <td class="py-4 px-6 text-sm capitalize">{{ $user->status }}</td>
                                <td class="py-4 px-6 space-x-2">
                                    <!-- Approve Action -->
                                    @if($user->status == 'pending')
                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:outline-none transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to approve this user?')">Approve</button>
                                        </form>
                                    @endif

                                    <!-- Readmit Action -->
                                    @if(in_array($user->status, ['rejected', 'denied']))
                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to readmit this user?')">Readmit</button>
                                        </form>
                                    @endif

                                    <!-- Remove Action -->
                                    @if($user->status == 'approved')
                                        <form action="{{ route('admin.users.remove', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to remove this user? This will change the status to rejected.')">Remove</button>
                                        </form>
                                    @endif
                                </td>
                                <td class="py-4 px-6 space-x-2">
                                    <!-- Promote to Admin -->
                                    @if($user->status == 'approved' && $user->role !== 'admin')
                                        <form action="{{ route('admin.users.promote', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to promote this user to admin?')">Promote to Admin</button>
                                        </form>
                                    @endif

                                    <!-- Depromote Admin -->
                                    @if($user->role === 'admin' && $user->previous_role)
                                        <form action="{{ route('admin.users.depromote', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:outline-none transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to depromote this admin to their previous role?')">Depromote</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tailwind JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</x-app-layout>