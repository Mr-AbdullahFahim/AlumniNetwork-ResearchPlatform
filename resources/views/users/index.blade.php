<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Filters -->
        <div class="flex justify-end space-x-4 mb-4">
            <!-- Role Filter -->
            <form method="GET" action="{{ route('users.index') }}" class="inline-block">
                <select name="role" onchange="this.form.submit()" class="bg-gray-800 text-white rounded px-3 py-2">
                    <option value="" {{ request('role') == '' ? 'selected' : '' }}>All Roles</option>
                    <option value="alumni" {{ request('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="lecturer" {{ request('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                </select>
            </form>

            <!-- Followed Filter -->
            <form method="GET" action="{{ route('users.index') }}" class="inline-block">
                <select name="followed" onchange="this.form.submit()" class="bg-gray-800 text-white rounded px-3 py-2">
                    <option value="">All</option>
                    <option value="1">Followed</option>
                    <option value="0">Not Followed</option>
                </select>
            </form>
        </div>


        <!-- User Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($users as $user)
                @if($user->id!=$me->id && $user->role!='admin')
                    <div class="bg-gray-700 p-6 rounded-lg text-center shadow-md">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('profileDefault.png') }}" alt="{{ $user->name }}" class="w-24 h-24 mx-auto rounded-full mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-white">{{ $user->name }}</h3>
                        <p class="text-indigo-400">{{ $user->email }}</p>
                        <p class="text-gray-300 mt-2">{{ $user->description ?? 'No description provided.' }}</p>

                        <form action="{{ route('users.' . (Auth::user()->follows->contains($user->id) ? 'unfollow' : 'follow'), $user->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded">
                                {{ Auth::user()->follows->contains($user->id) ? 'Followed' : 'Follow' }}
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
