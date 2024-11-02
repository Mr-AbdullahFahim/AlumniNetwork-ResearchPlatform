<div class="p-6 bg-gray-800 shadow-md rounded-lg m-3">
    <h2 class="text-xl font-bold text-white">{{ $job->title }}</h2>
    <p class="text-gray-400">{{ $job->company }} - {{ $job->location }}</p>
    <p class="mt-2 text-gray-300">{{ \Illuminate\Support\Str::limit($job->description, 38) }}</p>

    <div class="mt-4">
        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-xl {{ $job->type == 'job' ? 'bg-green-600 text-white' : 'bg-blue-600 text-white' }}">
            {{ ucfirst($job->type) }}
        </span>
        <p class="text-sm text-gray-500 mt-2">Posted on {{ $job->posted_at->format('F j, Y') }}</p>
    </div>

    <!-- Details Button -->
    <div class="mt-4">
        <button 
            class="border border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded transition-colors duration-300"
            onclick="document.getElementById('jobDetailsModal{{ $job->id }}').classList.remove('hidden')">
            Details
        </button>
    </div>
</div>

<!-- Job Details Modal -->
<div id="jobDetailsModal{{ $job->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-80">
    <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-2xl font-semibold text-white">{{ $job->title }}</h3>
        <p class="text-gray-400">{{ $job->company }} - {{ $job->location }}</p>
        <p class="text-gray-300 mt-2">{{ $job->description }}</p>
        <p class="text-sm text-gray-500 mt-2">Job Type: {{ ucfirst($job->type) }}</p>
        <p class="text-sm text-gray-500 mt-2">Posted on: {{ $job->posted_at->format('F j, Y') }}</p>
        <a href="{{ $job->job_link }}" target="_blank" class="inline-block bg-blue-500 text-white font-semibold mr-2 py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 ease-in-out">
            Apply<span class="fas fa-arrow-right ml-2"></span>
        </a>
        <button 
            class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
            onclick="document.getElementById('jobDetailsModal{{ $job->id }}').classList.add('hidden')">
            Close
        </button>
    </div>
</div>