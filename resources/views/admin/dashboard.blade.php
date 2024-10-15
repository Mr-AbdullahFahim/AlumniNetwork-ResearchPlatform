<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Link to the compiled CSS file -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard.css') }}">

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->

    <style>
        /* General Body Styles */
        body {
            background-color: #121417; /* Darker shade for better contrast */
            color: #f1f1f1; /* Soft white text for better readability */
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            background-color: #1f2329;
            padding: 20px;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
        }

        .sidebar a {
            text-decoration: none;
            color: #dfe4ea;
            display: block;
            padding: 15px 0;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #2e353d;
            color: #fff;
            border-radius: 5px;
        }

        .sidebar .active {
            background-color: #0984e3;
            color: #fff;
            border-radius: 5px;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            background-color: #121417;
        }

        /* Dashboard Header */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }

        .dashboard-header h2 {
            font-size: 24px;
            color: #fff;
        }

        /* Stats Boxes */
        .stats {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        .stat-box {
            background-color: #2d353d;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 22%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stat-box h3 {
            font-size: 16px; /* Reduced text size for titles */
            margin-bottom: 10px;
            color: #fff;
        }

        .stat-box p {
            font-size: 24px; /* Reduced text size for numbers */
            font-weight: bold;
            color: #0984e3;
        }

        /* Pending Requests Section */
        .pending-requests {
            margin-top: 40px;
            background-color: #2d353d;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .pending-requests table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .pending-requests th,
        .pending-requests td {
            padding: 15px;
            text-align: left;
            color: #fff;
        }

        .pending-requests th {
            background-color: #232c35;
        }

        .pending-requests tr:hover {
            background-color: #3b434a;
        }

        /* Adjust the "Pending User Requests" Text */
        .pending-requests h4 {
            font-size: 20px; /* Adjust the font size */
            color: #fff;
            margin-bottom: 15px;
        }

        /* Action Buttons */
        .action-buttons button {
            background-color: #0984e3;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-buttons button:hover {
            background-color: #74b9ff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #1f2329;
            position: fixed;
            bottom: 0;
            width: 100%;
            color: #7f8c8d;
        }

        /* Icon Bar Styles */
        .icon-bar {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .icon-bar a {
            color: #b2bec3;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .icon-bar a:hover {
            color: #0984e3;
        }

        /* Badge Styles */
        .badge {
            background-color: #e74c3c;
            color: #fff;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 14px;
            margin-left: 5px;
        }

        /* Dropdown Menu Styles */
        .dropdown-menu-dark {
            background-color: #2d353d;
            border: none;
        }

        .dropdown-menu-dark a {
            color: #dfe4ea;
            font-size: 16px;
        }

        .dropdown-menu-dark a:hover {
            background-color: #3b434a;
            color: #fff;
        }
    </style>
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
                <p>{{ $pendingRequestsCount }}</p> <!-- Use pendingRequestsCount variable -->
            </div>
            <div class="stat-box">
                <h3>Denied Requests</h3>
                <p>{{ $deniedRequests }}</p>
            </div>
        </div>

        <!-- Pending Requests Section -->
        <div class="pending-requests">
            <h4>Pending User Requests <span class="badge">{{ $pendingRequestsCount }}</span></h4>
            <table>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                @foreach($pendingRequests as $request)
                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->type }}</td>
                            <td>
                                <div class="action-buttons">
                                    <form method="POST" action="{{ route('admin.approve', $request->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.deny', $request->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Deny</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2024 Admin Dashboard. All Rights Reserved.
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
