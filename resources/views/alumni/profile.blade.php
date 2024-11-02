<x-app-layout>
    <div class="container mx-auto mt-10 p-6 bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden" style="max-width: 900px;"> <!-- Fixed width applied here -->
        <!-- Profile Section -->
        <div class="mb-8">
            <div class="flex flex-col items-center relative group"> <!-- Add 'relative' and 'group' classes -->
                <div class="text-center mb-6">
                    <div class="w-36 h-36 rounded-full overflow-hidden cursor-pointer" onclick="uploadImg()">
                        <img src="../../../storage/{{$user->profile_image}}" alt="Profile Picture" 
                            class="w-full h-full object-cover mx-auto mb-4 hover:opacity-75 transition-opacity duration-300">
                    </div>

                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" class="hidden">
                        @csrf
                        @method('PATCH')
                        <input type="file" id="profile_image" name="profile_image" class="hidden" onchange="uploadProfilePic()">
                        <input type="submit" id="profileUpdate" value="submit" class="hidden">
                    </form>
                        @if ($errors->has('profile_image'))
                            <div class="text-red-500">{{ $errors->first('profile_image') }}</div>
                        @endif
                     <!-- Hidden input for file upload -->
                    <h2 class="text-2xl font-semibold">{{ ucfirst($user->name) }}</h2>
                    <p class="text-gray-400 mt-2">{{ $user->profession }}</p>
                </div>
                <h3 class="text-xl font-semibold mb-2">Bio</h3>
                <p class="text-gray-300 mt-2 text-center px-6 md:px-24">
                    {{ $user->bio }}
                </p>

                <!-- Feedback for adding profile picture -->
                <div class="absolute bottom-0 mb-2 text-gray-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Click to upload a profile picture
                </div>

                <!-- Social Links -->
                <div class="mt-4 flex space-x-4">
                    @if($user->google_scholar)
                    <a href="{{ $user->google_scholar }}" target="_blank" class="text-gray-400 hover:text-gray-200">
                        <i class="fab fa-google-scholar text-2xl"></i>
                    </a>
                    @endif
                    @if($user->github)
                    <a href="{{ $user->github }}" target="_blank" class="text-gray-400 hover:text-gray-200">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <script>
            const profile_image = document.getElementById('profile_image');
            const profileUpdate = document.getElementById('profileUpdate');

            function uploadImg() {
                profile_image.click();  // Opens the file picker
            }

            function uploadProfilePic() {
                profileUpdate.click();  // Submits the form
            }
        </script>

        <!-- Jobs Section -->
        @if($user->role!='user')
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Jobs and Internships</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                @forelse($jobsAndInterns as $job) 
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

                        <button 
                            class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                            onclick="document.getElementById('jobDetailsModal{{ $job->id }}').classList.add('hidden')">
                            Close
                        </button>
                    </div>
                </div>
                @empty
                    <p class="text-gray-400">No jobs or internships added yet.</p>
                @endforelse
            </div>

            <!-- Add Job/Internship Button -->
            <button 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4 transition duration-200" 
                onclick="document.getElementById('jobModal').classList.remove('hidden')">
                Add Job/Internship
            </button>
        </div>
        @endif

        <!-- Research Articles Section -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Research Articles</h3>

            <div id="content" class="mt-4">
            <div class="max-w-7xl mx-auto ml-2 pb-4">
                @foreach ($researchArticles as $article)
                    <div class="bg-gray-800 p-4 shadow-md rounded-lg mb-4">
                        <h2 class="text-xl font-bold text-white">{{ $article->title }}</h2>
                        <p class="text-gray-300">{{ $article->description }}</p>
                        <p class="text-gray-400"><strong>Author:</strong> {{ $article->author }}</p>
                        <p class="text-gray-400"><strong>Posted on:</strong> {{ $article->created_at->format('F j, Y') }}</p>

                        @if($article->latestVersion)
                            <!-- Button to open the PDF in a modal popup -->
                            <a href="{{ Storage::url($article->latestVersion->file_path) }}" class="text-blue-400 hover:text-blue-500" download="{{ $article->title }}.pdf">Download Latest PDF</a>
                        @else
                            <p class="text-red-500">No versions available</p>
                        @endif

                        <!-- Button to open version history modal -->
                        <button class="text-sm text-blue-400 hover:text-blue-500" onclick="showVersionHistory({{ $article->id }})">View Versions</button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal for Uploading New Version -->
        <div id="versionModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold text-gray-200">Upload New Version</h3>
                <form id="uploadVersionForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="article_id" id="article_id" value="">

                    <!-- Version Number Field -->
                    <div class="mb-4">
                        <label for="version" class="block text-gray-300">Version</label>
                        <input type="text" id="version" name="version" class="w-full px-4 py-2 bg-gray-800 text-white rounded border border-gray-600" placeholder="Enter version number">
                    </div>

                    <!-- PDF File Upload -->
                    <div class="mb-4">
                        <label for="file" class="block text-gray-300">Upload PDF</label>
                        <input type="file" id="file" name="file" class="w-full bg-gray-800 text-white rounded border border-gray-600">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">Submit</button>
                    <button type="button" onclick="closeVersionModal()" class="text-gray-300 hover:text-gray-200">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Modal for PDF viewer -->
        <div id="pdfModal" class="modal hidden fixed inset-0 z-30 overflow-y-auto bg-gray-900 bg-opacity-75 flex items-center justify-center">
            <div class="bg-gray-800 rounded-lg shadow-xl sm:w-full sm:max-w-4xl p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">PDF Viewer</h2>
                    <button onclick="closePdfModal()" class="text-red-600 font-bold">Close</button>
                </div>
                <div class="mt-4">
                    <iframe id="pdfIframe" src="" style="height:600px" class="w-full border border-gray-600 rounded-lg"></iframe>
                </div>
            </div>
        </div>

        <!-- Modal for version history -->
        @foreach ($researchArticles as $article)
            <div id="versionHistoryModal-{{ $article->id }}" class="modal hidden fixed z-20 inset-0 overflow-y-auto bg-gray-800 bg-opacity-50 flex items-center justify-center">
                <div class="bg-gray-900 rounded-lg shadow-xl transform transition-all sm:w-full sm:max-w-lg p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">Version History - {{ $article->title }}</h2>
                        <button onclick="closeModal({{ $article->id }})" class="text-red-600">Close</button>
                    </div>

                    <div class="mt-4">
                        @if($article->versions->count() > 0)
                            <ul>
                                @foreach($article->versions as $version)
                                    <li class="mb-2">
                                        <a onclick="openPdfInModal('{{ Storage::url($article->latestVersion->file_path) }}')" class="text-blue-400 hover:text-blue-500 cursor-pointer">Version {{ $version->version }}</a>
                                        <span class="text-sm text-gray-300">(Uploaded on: {{ $version->created_at->format('F j, Y') }})</span>
                                    </li>
                                @endforeach
                                <!-- Button to Upload New Version -->
                                <button class="text-sm text-blue-400 hover:text-blue-500" onclick="openVersionModal({{ $article->id }})">Upload New Version</button>
                            </ul>
                        @else
                            <p class="text-gray-300">No versions available.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
            <!-- Add Research Article Button -->
            <button 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4 transition duration-200" 
                onclick="document.getElementById('researchModal').classList.remove('hidden')">
                Add Research Article
            </button>
        </div>

        <!-- Job Modal -->
        @if($user->role!='user')
        <div id="jobModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-80">
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-xl font-semibold mb-4">Add Job/Internship</h3>
                <form method="POST" action="{{ route('jobs.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="job-title" class="block text-gray-300">Job Title</label>
                        <input type="text" id="job-title" name="title" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter job title" required>
                    </div>
                    <div class="mb-4">
                        <label for="company" class="block text-gray-300">Company</label>
                        <input type="text" id="company" name="company" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter company name" required>
                    </div>
                    <div class="mb-4">
                        <label for="locationType" class="block text-gray-300">Location Type</label>
                        <select id="locationType" onchange="showLocationInput()" name="locationType" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" required>
                            <option value="Onsite" selected="selected">Onsite</option>
                            <option value="Remote">Remote</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="mb-4" id="locationInput">
                        <label for="location" class="block text-gray-300">Location</label>
                        <input type="text" id="location" name="location" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Enter location" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" placeholder="Description" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-300">Type</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" required>
                            <option value="job">Job</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
                    <button type="button" class="text-gray-300 hover:text-gray-200" onclick="document.getElementById('jobModal').classList.add('hidden')">Cancel</button>
                </form>
            </div>
        </div>
        @endif

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
                            class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" 
                            required 
                            placeholder="Enter research article title">
                    </div>

                    <!-- Description Field -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" 
                            placeholder="Enter research article description"></textarea>
                    </div>

                    <!-- Author Field -->
                    <div class="mb-4">
                        <label for="author" class="block text-gray-300 font-medium mb-2">Author</label>
                        <input 
                            type="text" 
                            name="author" 
                            id="author" 
                            class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white" 
                            placeholder="Enter author name">
                    </div>

                    <!-- File Upload -->
                    <div class="mb-4">
                        <label for="file" class="block text-gray-300 font-medium mb-2">Upload PDF</label>
                        <input 
                            type="file" 
                            name="file" 
                            id="file" 
                            class="w-full text-gray-300 bg-gray-800 py-2 px-3 border border-gray-600 rounded">
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Upload
                        </button>
                        <button 
                            type="button" 
                            class="text-gray-300 hover:text-gray-200 ml-4" 
                            onclick="document.getElementById('researchModal').classList.add('hidden')">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show version history modal
        function showVersionHistory(articleId) {
            document.getElementById(`versionHistoryModal-${articleId}`).classList.remove('hidden');
            document.getElementById('content').classList.add('blur-sm'); // Apply blur effect
        }

        // Close the version history modal
        function closeModal(articleId) {
            document.getElementById(`versionHistoryModal-${articleId}`).classList.add('hidden');
            document.getElementById('content').classList.remove('blur-sm'); // Remove blur effect
        }

        function openVersionModal(articleId) {
            document.getElementById('article_id').value = articleId; // Set the hidden input value

            // Set the form action dynamically
            const form = document.getElementById('uploadVersionForm');
            form.action = `{{ url('research-articles/${articleId}/version') }}`; // Use articleId to create the URL

            document.getElementById('versionModal').classList.remove('hidden'); // Show the modal
        }

        function closeVersionModal() {
            document.getElementById('versionModal').classList.add('hidden'); // Hide the modal
        }

        // Show location input based on type
        function showLocationInput() {
            const locationType = document.getElementById("locationType").value;
            const locationInput = document.getElementById("locationInput");
            const location = document.getElementById("location");

            if (locationType === "Remote") {
                locationInput.classList.add('hidden');
                location.required = false;
            } else {
                locationInput.classList.remove('hidden');
                location.required = true;
            }
        }

        // Open PDF in modal
        function openPdfInModal(pdfUrl) {
            document.getElementById('pdfIframe').src = pdfUrl;
            document.getElementById('pdfModal').classList.remove('hidden');
            document.getElementById('content').classList.add('blur-sm'); // Apply blur effect
        }

        // Close PDF modal
        function closePdfModal() {
            document.getElementById('pdfModal').classList.add('hidden');
            document.getElementById('content').classList.remove('blur-sm'); // Remove blur effect
            document.getElementById('pdfIframe').src = ''; // Reset iframe src
        }
    </script>

</x-app-layout>
