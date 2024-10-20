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
    @foreach ($articles as $article)
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
                        </ul>
                    @else
                        <p class="text-gray-300">No versions available.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <!-- Scripts to handle the modal behavior -->
    <script>
        function openPdfInModal(pdfUrl) {
            // Set the iframe src to the PDF URL
            document.getElementById('pdfIframe').src = pdfUrl;

            // Show the modal by removing the 'hidden' class
            document.getElementById('pdfModal').classList.remove('hidden');

            // Apply the blur effect to the main content
            document.getElementById('content').classList.add('blur-sm');
        }

        function closePdfModal() {
            // Hide the modal by adding the 'hidden' class
            document.getElementById('pdfModal').classList.add('hidden');

            // Remove the blur effect from the main content
            document.getElementById('content').classList.remove('blur-sm');

            // Reset the iframe src to remove the PDF (optional)
            document.getElementById('pdfIframe').src = '';
        }

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