<!-- sidebar.blade.php -->
<div class="sidebar">
    <div class="text-center">
        <img src="https://via.placeholder.com/80" class="rounded-circle mb-3" alt="Admin Photo">
        <h4>Admin</h4>
    </div>
    <hr>
    
    <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Home
    </a>

    <a href="{{ route('admin.home') }}" class="{{ Request::is('admin/home') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>

    <a href="{{ route('admin.users') }}" class="{{ Request::is('admin/users') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Users
    </a>

    <a href="{{ route('admin.approvals') }}" class="{{ Request::is('admin/approvals') ? 'active' : '' }}">
        <i class="fas fa-tasks"></i> Approvals
    </a>

    <a href="{{ route('admin.reports') }}" class="{{ Request::is('admin/reports') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i> Reports
    </a>
</div>
