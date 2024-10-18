<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Link to the compiled CSS file -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">


    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</head>
<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <div class="icon-bar">
                <a href="{{ route('admin.notifications') }}" title="Notifications">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="badge">{{ $pendingRequestsCount }}</span>
                </a>
                <a href="{{ route('admin.inbox') }}" title="Inbox">
                    <i class="fas fa-envelope fa-lg"></i>
                </a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Settings</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                            </form>
                        </li>
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
                <p>{{ $pendingRequestsCount }}</p>
            </div>
            <div class="stat-box">
                <h3>Denied Requests</h3>
                <p>{{ $deniedRequests }}</p>
            </div>
        </div>

        <!-- Pending Requests Section -->
        <div class="pending-requests">
            <h4>Pending User Requests <span class="badge">{{ $pendingRequestsCount }}</span></h4>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Requested</th>
                        <th>User Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingRequests as $request)
                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->created_at->format('d/m/Y') }}</td>
                            <td>{{ $request->role }}</td>
                            <td class="action-buttons">
                                <form action="{{ route('admin.approve', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.deny', $request->id) }}" method="POST">
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
    <footer class="footer">
        &copy; 2024 Admin Dashboard - All Rights Reserved.
    </footer>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
