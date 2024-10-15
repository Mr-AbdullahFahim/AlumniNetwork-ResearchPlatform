<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Upload Research Article</h1>

        <form action="{{ route('research-article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter the article title"
                    required
                >
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Write a brief description"
                    required
                ></textarea>
            </div>

            <!-- Author Field -->
            <div class="mb-4">
                <label for="author" class="block text-gray-700 font-medium mb-2">Author</label>
                <input 
                    type="text" 
                    name="author" 
                    id="author" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter the author's name"
                    required
                >
            </div>

            <!-- File Upload Field -->
            <div class="mb-6">
                <label for="file" class="block text-gray-700 font-medium mb-2">Upload PDF</label>
                <input 
                    type="file" 
                    name="file" 
                    id="file" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
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
            </div>
        </form>
    </div>
</x-app-layout>
