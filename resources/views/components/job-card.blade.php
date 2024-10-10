<div class="p-6 bg-white shadow-md rounded-lg m-3">
    <h2 class="text-xl font-bold">{{ $job->title }}</h2>
    <p class="text-gray-600">{{ $job->company }} - {{ $job->location }}</p>
    <p class="mt-2 text-gray-500">{{ \Illuminate\Support\Str::limit($job->description, 38) }}</p>

    <div class="mt-4">
        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-xl {{ $job->type == 'job' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
            {{ ucfirst($job->type) }}
        </span>
        <p class="text-sm text-gray-400 mt-2">Posted on {{ $job->posted_at->format('F j, Y') }}</p>
    </div>
</div>
