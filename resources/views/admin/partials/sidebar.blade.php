<!-- sidebar.blade.php -->
<div class="sidebar bg-dark text-white p-4 w-64 fixed h-full">
    <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : '' }} text-white">
        <i class="fas fa-home"></i> Home
    </a>
    <br>
    <br>

    <a href="{{ route('admin.home') }}" class="{{ Request::is('admin/home') ? 'active' : '' }} text-white">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <br>
    <br>

    <a href="{{ route('admin.users') }}" class="{{ Request::is('admin/users') ? 'active' : '' }} text-white">
        <i class="fas fa-users"></i> User Roles
    </a>
    <br>
    <br>

    <a href="{{ route('admin.promote') }}" class="{{ Request::is('admin/promote') ? 'active' : '' }} text-white">
        <i class="fas fa-arrow-up"></i> Promote to Admin
    </a>
    <br>
    <br>

    <a href="{{ route('admin.reports') }}" class="{{ Request::is('admin/reports') ? 'active' : '' }} text-white">
        <i class="fas fa-chart-line"></i> Reports
    </a>
    <br>
    <br>

</div>
