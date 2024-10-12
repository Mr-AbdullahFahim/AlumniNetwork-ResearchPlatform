<x-app-layout>
    <div class="max-w-7xl mx-auto lg:px-8 text-white mt-6">
        <div>
            <h1 class="text-3xl font-extrabold mx-3">Research Articles</h1>
        </div>
    </div>

    <!-- Main content that will be blurred when modal is active -->
    <div id="content" class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-4 px-4">
            @foreach ($articles as $article)
                <div class="bg-white p-4 shadow-md rounded-lg mb-4">
                    <h2 class="text-xl font-bold">{{ $article->title }}</h2>
                    <p>{{ $article->description }}</p>
                    <p><strong>Author:</strong> {{ $article->author }}</p>
                    <p><strong>Posted on:</strong> {{ $article->created_at->format('F j, Y') }}</p>

                    @if($article->latestVersion)
                        <a href="{{ Storage::url($article->latestVersion->file_path) }}" class="text-blue-500">Download Latest PDF</a>
                    @else
                        <p class="text-red-500">No versions available</p>
                    @endif

                    <!-- Button to open version history modal -->
                    <button class="text-sm text-blue-600" onclick="showVersionHistory({{ $article->id }})">View Versions</button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal for version history (moved outside #content to avoid blur) -->
    @foreach ($articles as $article)
        <div id="versionHistoryModal-{{ $article->id }}" class="modal hidden fixed z-20 inset-0 overflow-y-auto backdrop-blur-none bg-gray-800 bg-opacity-50 flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg shadow-xl transform transition-all sm:w-full sm:max-w-lg p-6 z-30">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Version History - {{ $article->title }}</h2>
                    <button onclick="closeModal({{ $article->id }})" class="text-red-600">Close</button>
                </div>

                <div class="mt-4">
                    @if($article->versions->count() > 0)
                        <ul>
                            @foreach($article->versions as $version)
                                <li class="mb-2">
                                    <a href="{{ Storage::url($version->file_path) }}" class="text-blue-500">Version {{ $version->version }}</a>
                                    <span class="text-sm text-gray-600">(Uploaded on: {{ $version->created_at->format('F j, Y') }})</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No versions available.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function showVersionHistory(articleId) {
            // Show the modal by removing the 'hidden' class
            document.getElementById('versionHistoryModal-' + articleId).classList.remove('hidden');

            // Apply the blur effect to the main content
            document.getElementById('content').classList.add('blur-sm');
        }

        function closeModal(articleId) {
            // Hide the modal by adding the 'hidden' class
            document.getElementById('versionHistoryModal-' + articleId).classList.add('hidden');

            // Remove the blur effect from the main content
            document.getElementById('content').classList.remove('blur-sm');
        }
    </script>
</x-app-layout>