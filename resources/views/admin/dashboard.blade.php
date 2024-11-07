<x-app-layout>
<div class="flex h-screen bg-gray-900 text-white">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 p-4">
        @include('admin.partials.sidebar')
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-6 bg-gray-900 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-gray-800 scrollbar-rounded-lg">
        <!-- Welcome Section -->
        <div class="w-4/5">
            <h4 class="my-2 text-xl">Welcome, Admin!</h4>
            <h2 class="text-7xl font-extrabold">Admin Dashboard</h2>
            <p class="w-4/5 my-3 text-xl font-thin">
                <i>Manage user requests, monitor activity, and ensure a smooth experience across the platform.</i>
            </p>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
            <!-- Total Users -->
            <div class="bg-white text-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-2xl font-semibold">Total Users</h3>
                <p class="text-4xl font-bold">{{ $totalUsers }}</p>
            </div>
            <!-- Approved Users -->
            <div class="bg-white text-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-2xl font-semibold">Approved Users</h3>
                <p class="text-4xl font-bold">{{ $approvedUsers }}</p>
            </div>
            <!-- Pending Requests -->
            <div class="bg-white text-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-2xl font-semibold">Pending Requests</h3>
                <p class="text-4xl font-bold">{{ $pendingRequestsCount }}</p>
            </div>
            <!-- Denied Requests -->
            <div class="bg-white text-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-2xl font-semibold">Denied Requests</h3>
                <p class="text-4xl font-bold">{{ $deniedRequests }}</p>
            </div>
        </div>

        <!-- Pending Requests Table -->
        <div class="mt-12">
            <h2 class="text-3xl font-extrabold text-white">Pending User Requests</h2>
            <div class="bg-white p-6 rounded-xl shadow-md mt-4">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-white text-gray-800 p-6 rounded-xl shadow-md">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Date Requested</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRequests as $request)
                            <tr class="bg-white text-black hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $request->name }}</td>
                                <td class="px-4 py-2">{{ $request->email }}</td>
                                <td class="px-4 py-2">{{ $request->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $request->role }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.approve', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.deny', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Deny</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
