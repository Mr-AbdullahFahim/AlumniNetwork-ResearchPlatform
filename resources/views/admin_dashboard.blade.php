<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Link to the compiled CSS file -->
    <link href="../css/admin-dashboard.css" rel="stylesheet">

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center">
            <img src="https://via.placeholder.com/80" class="rounded-circle mb-3" alt="Admin Photo">
            <h4>Admin</h4>
        </div>
        <hr>
        <a href="{{ route('admin.home') }}" class="{{ Request::is('admin/home') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Home
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
        <a href="{{ route('admin.settings') }}" class="{{ Request::is('admin/settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{ route('admin.logout') }}">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <div class="icon-bar">
                <!-- Notification Button -->
                <a href="{{ route('admin.notifications') }}" title="Notifications">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="badge">{{ $pendingRequestsCount }}</span> <!-- Displays pending requests count -->
                </a>
                <!-- Email/Inbox Button -->
                <a href="{{ route('admin.inbox') }}" title="Inbox">
                    <i class="fas fa-envelope fa-lg"></i>
                </a>
                <!-- Admin Profile Dropdown -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">View Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats">
            <div class="stat-box">
                <h3>Total Users</h3>
                <p>{{ $totalUsers }}</p>
            </div>
            <div class="stat-box">
                <h3>Approved Users</h3>
                <p>{{ $approvedUsers }}</p>
            </div>
            <div class="stat-box">
                <h3>Pending Requests</h3>
                <p>{{ $pendingRequests }}</p>
            </div>
            <div class="stat-box">
                <h3>Denied Requests</h3>
                <p>{{ $deniedRequests }}</p>
            </div>
        </div>

        <!-- Pending Requests Section -->
        <div class="pending-requests">
            <h4>Pending User Requests</h4>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingRequests as $request)
                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->type }}</td>
                            <td class="action-buttons">
                                <form method="POST" action="{{ route('admin.approve', $request->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.deny', $request->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Research and Alumni Dashboard</p>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
