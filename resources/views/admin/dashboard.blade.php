<x-app-layout>
<div class="flex h-screen bg-gray-900 text-white">
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 p-8 bg-gray-900 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
            <!-- Total Users -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-400">Total Users</h3>
                <p class="text-5xl font-extrabold text-gray-100 mt-2">{{ $totalUsers }}</p>
            </div>
            <!-- Approved Users -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-400">Approved Users</h3>
                <p class="text-5xl font-extrabold text-gray-100 mt-2">{{ $approvedUsers }}</p>
            </div>
            <!-- Pending Requests -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-400">Pending Requests</h3>
                <p class="text-5xl font-extrabold text-gray-100 mt-2">{{ $pendingRequestsCount }}</p>
            </div>
            <!-- Denied Requests -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                <h3 class="text-lg font-semibold text-gray-400">Denied Requests</h3>
                <p class="text-5xl font-extrabold text-gray-100 mt-2">{{ $deniedRequests }}</p>
            </div>
        </div>

        <!-- Pending Requests Table -->
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-200">Pending User Requests</h2>
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg mt-6">
                <table class="min-w-full table-auto text-gray-300 rounded-md overflow-hidden">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Email</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Date Requested</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Role</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">NIC</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Student ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRequests as $request)
                            <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700 transition duration-200">
                                <td class="px-6 py-4">{{ $request->name }}</td>
                                <td class="px-6 py-4">{{ $request->email }}</td>
                                <td class="px-6 py-4">{{ $request->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 capitalize">{{ $request->role }}</td>
                                <td class="px-6 py-4 capitalize">{{ $request->nic }}</td>
                                <td class="px-6 py-4 capitalize">{{ $request->indexNo?$request->indexNo:"None"}}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('admin.approve', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-150">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deny', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-150">
                                                Deny
                                            </button>
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