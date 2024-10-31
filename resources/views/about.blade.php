<x-app-layout>
    <div class="max-w-7xl mx-auto lg:px-8 text-white mt-6">
        <!-- Page Heading -->
        <div>
            <h1 class="text-3xl font-extrabold mx-3">About Us</h1>
            <p class="text-lg text-gray-400 mx-3 mt-2">Discover more about our mission, vision, and the team dedicated to making a difference.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Our Mission Section -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-3">Our Mission</h2>
                <p class="text-gray-300 leading-relaxed">We strive to empower students, alumni, and professionals by providing a platform that fosters growth, collaboration, and opportunities. Our mission is to bridge the gap between education and professional development, fostering a community of learning and innovation.</p>
            </div>

            <!-- Our Vision Section -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-3">Our Vision</h2>
                <p class="text-gray-300 leading-relaxed">To be a leading hub for knowledge exchange, professional networking, and academic collaboration that inspires individuals to excel in their chosen fields and make a meaningful impact in society.</p>
            </div>

            <!-- Meet the Team Section -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-3">Meet the Team</h2>
                <p class="text-gray-300 leading-relaxed mb-4">Our team consists of dedicated professionals and passionate individuals who are committed to supporting our mission and helping our users achieve success.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Team Member Card -->
                    @foreach($teamMembers as $member)
                        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <!-- Profile Image -->
                            <img src="{{ $member->image ?? asset('images/default-profile.png') }}" alt="{{ $member->name }}" class="w-full h-48 object-cover">
                            
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-semibold text-white">{{ $member->name }}</h3>
                                <p class="text-sm font-medium text-indigo-400">{{ $member->role }}</p>
                                <p class="mt-2 text-gray-300">{{ $member->description }}</p>

                                <!-- Social Media Links with Customized Spacing -->
                                <div class="mt-6 flex justify-center">
                                    @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" class="mx-4 text-indigo-400 hover:text-indigo-300" target="_blank">
                                            <i class="fab fa-linkedin fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="mx-4 text-red-400 hover:text-red-300" target="_blank">
                                            <i class="fas fa-envelope fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($member->github)
                                        <a href="{{ $member->github }}" class="mx-4 text-gray-400 hover:text-gray-300" target="_blank">
                                            <i class="fab fa-github fa-lg"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
