<x-app-layout>
    <div class="container mx-auto my-10 p-6 bg-gray-900 text-white rounded-lg shadow-lg">
        <!-- Profile Section -->
        <div class="mb-8">
            <div class="flex flex-col items-center">
                <div class="text-center mb-6">
                    <img src="https://via.placeholder.com/120" alt="Profile Picture" class="rounded-full mx-auto mb-4">
                    <h2 class="text-2xl font-semibold">John Doe</h2>
                    <p class="text-gray-400 mt-2">Software Engineer | Tech Enthusiast</p>
                </div>
                <h3 class="text-xl font-semibold">Bio</h3>
                <p class="text-gray-300 mt-2 text-center px-24">
                    John Doe is an experienced software engineer with a passion for developing innovative programs that expedite the efficiency and effectiveness of organizational success. He is skilled in various programming languages and enjoys collaborating with others to bring ideas to life.
                </p>

                <!-- Social Links -->
                <div class="mt-4 flex space-x-4">
                    <a href="https://scholar.google.com/citations?user=YOUR_GOOGLE_SCHOLAR_ID" target="_blank" class="text-gray-400 hover:text-gray-200">
                        <i class="fab fa-google-scholar text-2xl"></i>
                    </a>
                    <a href="https://github.com/YOUR_GITHUB_USERNAME" target="_blank" class="text-gray-400 hover:text-gray-200">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Jobs Section -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Jobs and Internships</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Job Card Example -->
                <div class="p-6 bg-gray-800 shadow-md rounded-lg">
                    <h2 class="text-xl font-bold">Example Job Title</h2>
                    <p class="text-gray-400">Example Company - Example Location</p>
                    <p class="mt-2 text-gray-300">This is a brief description of the job or internship opportunity. This can span multiple lines to provide sufficient detail.</p>
                    <div class="mt-4">
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-xl bg-green-600 text-white">Job</span>
                        <p class="text-sm text-gray-500 mt-2">Posted on January 1, 2024</p>
                    </div>
                </div>
            </div>
            <button 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4" 
                onclick="document.getElementById('jobModal').classList.remove('hidden')">
                Add Job/Internship
            </button>
        </div>

        <!-- Research Articles Section -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Research Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Research Article Card Example -->
                <div class="bg-gray-800 p-4 shadow-md rounded-lg mb-4">
                    <h2 class="text-xl font-bold">Example Research Article Title</h2>
                    <p class="text-gray-300">This is a brief description of the research article.</p>
                    <p class="text-gray-400"><strong>Author:</strong> Example Author</p>
                    <p class="text-gray-400"><strong>Posted on:</strong> January 1, 2024</p>
                    <a href="#" class="text-blue-500">Download Latest PDF</a>
                    <button class="text-sm text-blue-600 mt-2" onclick="showVersionHistory(1)">View Versions</button>
                </div>
            </div>
            <button 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4" 
                onclick="document.getElementById('researchModal').classList.remove('hidden')">
                Add Research Article
            </button>
        </div>

        <!-- Job Modal -->
        <div id="jobModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-80">
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold mb-4">Add Job/Internship</h3>
                <form>
                    <div class="mb-4">
                        <label for="job-title" class="block text-gray-300">Job Title</label>
                        <input type="text" id="job-title" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter job title">
                    </div>
                    <div class="mb-4">
                        <label for="company" class="block text-gray-300">Company</label>
                        <input type="text" id="company" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter company name">
                    </div>
                    <div class="mb-4">
                        <label for="duration" class="block text-gray-300">Duration</label>
                        <input type="text" id="duration" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter duration (e.g., Jan 2020 - Dec 2020)">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
                    <button type="button" class="text-gray-300 hover:text-gray-200" onclick="document.getElementById('jobModal').classList.add('hidden')">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Research Modal -->
        <div id="researchModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-80">
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
                <h1 class="text-2xl font-bold mb-6 text-gray-200">Upload Research Article</h1>
                <form action="{{ route('research-article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Field -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-300 font-medium mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter the article title"
                            required
                        >
                    </div>

                    <!-- Description Field -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Write a brief description"
                            required
                        ></textarea>
                    </div>

                    <!-- Author Field -->
                    <div class="mb-4">
                        <label for="author" class="block text-gray-300 font-medium mb-2">Author</label>
                        <input 
                            type="text" 
                            name="author" 
                            id="author" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter the author's name"
                            required
                        >
                    </div>

                    <!-- File Upload Field -->
                    <div class="mb-6">
                        <label for="file" class="block text-gray-300 font-medium mb-2">Upload PDF</label>
                        <input 
                            type="file" 
                            name="file" 
                            id="file" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            accept="application/pdf"
                            required
                        >
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <input 
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 focus:outline-none"
                            value="Submit"
                        >
                        <button type="button" class="text-gray-300 hover:text-gray-200 ml-4" onclick="document.getElementById('researchModal').classList.add('hidden')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>