<div class="sidebar bg-gray-800 text-gray-200 p-6 w-64 h-full flex flex-col space-y-6">
    <!-- Sidebar Link with Active State and Hover Effect -->
    <a href="{{ route('admin.home') }}" class="flex items-center space-x-3 text-gray-200 hover:text-gray-100 transition duration-150 ease-in-out {{ Request::is('admin/home') ? 'bg-gray-700 rounded-lg p-2' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 text-gray-200 hover:text-gray-100 transition duration-150 ease-in-out {{ Request::is('admin/users') ? 'bg-gray-700 rounded-lg p-2' : '' }}">
        <i class="fas fa-users"></i>
        <span>User Roles</span>
    </a>

    <a href="{{ route('admin.reports') }}" class="flex items-center space-x-3 text-gray-200 hover:text-gray-100 transition duration-150 ease-in-out {{ Request::is('admin/reports') ? 'bg-gray-700 rounded-lg p-2' : '' }}">
        <i class="fas fa-chart-line"></i>
        <span>Reports</span>
    </a>
</div>