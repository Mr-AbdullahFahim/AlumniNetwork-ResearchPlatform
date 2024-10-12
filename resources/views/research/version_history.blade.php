<x-app-layout>
    <div id="versionHistoryModal-{{ $article->id }}" style="display: none;">
        <h2>Version History for {{ $article->title }}</h2>
        
        <ul>
            @foreach ($versions as $version)
                <li>
                    <strong>Version {{ $version->version }}:</strong>
                    Uploaded on {{ $version->created_at->format('F j, Y') }}
                    <a href="{{ Storage::url($version->file_path) }}" class="text-blue-500">Download</a>
                </li>
            @endforeach
        </ul>
        <button onclick="closeModal({{ $article->id }})">Close</button>
    </div>
</x-app-layout>
