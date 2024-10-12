<x-app-layout>
    <div class="max-w-7xl mx-auto lg:px-8 text-white mt-6">
        <div>
            <h1 class="text-3xl font-extrabold mx-3">Jobs and Internships</h1>
        </div>
    </div>
    <div class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($jobs as $job)
                        <x-job-card :job="$job"/>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>