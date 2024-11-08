<!-- resources/views/admin/reports.blade.php -->

<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
                <h2 class="text-4xl font-extrabold text-white">Reports</h2>
            </div>

            <!-- User Count by Role -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-100 mb-4">User Count by Role</h3>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <table class="min-w-full text-gray-200">
                        <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
                            <tr>
                                <th class="py-4 px-6 text-left font-semibold">Role</th>
                                <th class="py-4 px-6 text-left font-semibold">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userCountByRole as $roleData)
                                <tr class="border-b border-gray-700">
                                    <td class="py-4 px-6">{{ ucfirst($roleData->role) }}</td>
                                    <td class="py-4 px-6">{{ $roleData->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Count by Status -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-100 mb-4">User Count by Status</h3>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <table class="min-w-full text-gray-200">
                        <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
                            <tr>
                                <th class="py-4 px-6 text-left font-semibold">Status</th>
                                <th class="py-4 px-6 text-left font-semibold">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userCountByStatus as $statusData)
                                <tr class="border-b border-gray-700">
                                    <td class="py-4 px-6 capitalize">{{ ucfirst($statusData->status) }}</td>
                                    <td class="py-4 px-6">{{ $statusData->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Additional Report Sections -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-100 mb-4">Additional Reports</h3>
                <!-- Additional tables or charts can be added here -->
            </div>
        </div>
    </div>

    <!-- Tailwind JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</x-app-layout>