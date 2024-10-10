<x-app-layout>
    <div class="max-w-7xl mx-auto lg:px-8 text-white mt-44">
        <div class="w-4/5">
            <h4 class="my-2 text-xl">Welcome {{$user}}!!</h4>
            <h2 class="text-7xl font-extrabold">Connect and Collaborate <br>to our Academic Community</h2>
            <p class="w-4/5 my-3 text-xl font-thin"><i>We bridge the gap between alumni, students, and faculty, offering a platform for networking, collaboration, and lifelong learning</i></p>
        </div>
        <button class="w-32 h-12 bg-slate-600 rounded-xl font-semibold mt-2 hover:bg-slate-700">Our Mission</button>
    </div>
    <div class="mt-44">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <h2 class="text-3xl font-extrabold mx-3 text-white">Recent Jobs</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-4">
                    @foreach($recentJobs as $job)
                        <x-job-card :job="$job"/>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>