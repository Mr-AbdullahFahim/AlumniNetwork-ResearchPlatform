<x-app-layout>
    <div class="max-w-7xl mx-auto lg:px-8 text-gray-200 mt-10">
        <!-- Page Heading -->
        <div class="mb-10 px-4">
            <h1 class="text-5xl font-bold text-white">About Us</h1>
            <p class="text-xl text-gray-300 mt-4 leading-relaxed">We’re committed to building an inclusive community that bridges the gap between students, alumni, and industry professionals. Learn more about our mission, vision, and the dedicated team working behind the scenes to empower future generations.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <!-- Our Mission Section -->
            <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
                <h2 class="text-4xl font-semibold mb-4 text-white">Our Mission</h2>
                <p class="text-lg text-gray-300 leading-relaxed">Our mission is to create a robust, supportive network where knowledge flows freely and opportunities are abundant. We believe in fostering a collaborative community that empowers individuals through a blend of resources, connections, and innovation. By bridging the academic and professional realms, we’re creating a platform where users can grow, collaborate, and achieve meaningful impact.</p>
            </div>

            <!-- Our Vision Section -->
            <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
                <h2 class="text-4xl font-semibold mb-4 text-white">Our Vision</h2>
                <p class="text-lg text-gray-300 leading-relaxed">Our vision is to be a trusted hub for knowledge exchange and professional networking. We aspire to cultivate a vibrant ecosystem that inspires individuals to pursue excellence in their fields, fostering a culture of lifelong learning and purpose-driven collaboration. By connecting alumni, students, and industry professionals, we are helping build a future where personal growth and professional success go hand in hand.</p>
            </div>

            <!-- Values Section -->
            <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
                <h2 class="text-4xl font-semibold mb-4 text-white">Our Core Values</h2>
                <ul class="list-disc list-inside space-y-3 text-lg text-gray-300">
                    <li><strong>Empowerment:</strong> We empower individuals with the resources and guidance they need to succeed.</li>
                    <li><strong>Integrity:</strong> We uphold the highest standards of honesty and transparency in all our interactions.</li>
                    <li><strong>Innovation:</strong> We encourage creativity and continuous learning to drive progress and impact.</li>
                    <li><strong>Community:</strong> We foster a supportive, collaborative environment that encourages personal and professional growth.</li>
                    <li><strong>Respect:</strong> We value diverse perspectives and promote inclusivity and empathy.</li>
                </ul>
            </div>

            <!-- Meet the Team Section -->
            <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
                <h2 class="text-4xl font-semibold mb-4 text-white">Meet the Team</h2>
                <p class="text-lg text-gray-300 leading-relaxed mb-8">Our team is composed of dedicated professionals who share a passion for learning, development, and community building. Each member brings a unique set of skills and perspectives, working together to make our vision a reality.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Team Member Card -->
                    @foreach($teamMembers as $member)
                        <div class="bg-gray-700 rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                            <!-- Profile Image -->
                            <img src="{{ $member->image ?? asset('images/default-profile.png') }}" alt="{{ $member->name }}" class="w-full h-52 object-contain rounded-full shadow-md">

                            <div class="p-6 text-center">
                                <h3 class="text-2xl font-semibold text-white">{{ $member->name }}</h3>
                                <p class="text-md font-medium text-gray-400">{{ $member->role }}</p>
                                <p class="mt-3 text-gray-300">{{ $member->description }}</p>

                                <!-- Social Media Links with Custom Spacing and Hover Effects -->
                                <div class="mt-6 flex justify-center space-x-6">
                                    @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" class="text-gray-400 hover:text-gray-300 transition" target="_blank">
                                            <i class="fab fa-linkedin fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="text-red-400 hover:text-red-300 transition" target="_blank">
                                            <i class="fas fa-envelope fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($member->github)
                                        <a href="{{ $member->github }}" class="text-gray-400 hover:text-gray-300 transition" target="_blank">
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