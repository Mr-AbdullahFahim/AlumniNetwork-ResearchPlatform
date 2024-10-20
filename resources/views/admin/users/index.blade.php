<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <!-- Add necessary styles and scripts -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h2>Manage Users</h2>
        </div>

        <!-- Filter Users by Role -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.users') }}">
                <label for="role" class="form-label">Filter by Role:</label>
                <select name="role" id="role" class="form-select" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request()->get('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request()->get('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="alumni" {{ request()->get('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
            </form>
        </div>

        <!-- Display Users -->
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th> <!-- Display the user's status -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name ?? 'Guest' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- Display status (Pending, Approved, Rejected or Denied) -->
                            {{ ucfirst($user->status) }}
                        </td>
                        <td>
                            <!-- Approve button (only visible if status is 'pending') -->
                            @if($user->status == 'pending')
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this user?')">
                                        Approve
                                    </button>
                                </form>
                            @endif

                            <!-- Readmit button (visible if status is 'rejected' or 'denied') -->
                            @if(in_array($user->status, ['rejected', 'denied']))
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to readmit this user?')">
                                        Readmit
                                    </button>
                                </form>
                            @endif

                            <!-- Remove button (only visible for 'approved' users) -->
                            @if($user->status == 'approved')
                                <form action="{{ route('admin.users.remove', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this user? This will change the status to rejected.')">
                                        Remove
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and any other necessary JS scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
