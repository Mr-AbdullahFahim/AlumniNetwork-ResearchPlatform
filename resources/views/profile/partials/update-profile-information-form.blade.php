<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="nic" :value="__('NIC')" />
            <x-text-input id="nic" name="nic" type="text" class="mt-1 block w-full" :value="old('nic', $user->nic ?? '')" required autocomplete="nic" />
            <x-input-error class="mt-2" :messages="$errors->get('nic')" />
        </div>

        <div class="mt-4">
            <x-input-label for="indexNo" :value="__('Index Number')" />
            <x-text-input id="indexNo" name="indexNo" type="text" class="mt-1 block w-full" :value="old('indexNo', $user->indexNo ?? '')" autocomplete="indexNo" />
            <x-input-error class="mt-2" :messages="$errors->get('indexNo')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full text-gray-700 dark:text-gray-200 bg-gray-800 dark:bg-gray-700 border border-gray-600 rounded-md focus:border-indigo-500 focus:ring-indigo-500" placeholder="Write a short bio about yourself">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Profile Image Upload -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <input id="profile_image" name="profile_image" type="file" class="mt-1 block w-full text-white bg-gray-800 rounded border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />

            <!-- Display current profile image or default profile image if not available -->
            <div class="mt-4">
                <img src="{{ $user->profile_image ? asset('../../../storage/' . $user->profile_image) : asset('profileDefault.png') }}" 
                     alt="Profile Image" class="w-24 h-24 rounded-full object-cover">
            </div>
        </div>

        <div class="mt-4">
            <button type="button" onclick="toggleLinkField('googleScholarField')" class="bg-blue-600 text-white px-3 py-1 rounded">Add Google Scholar</button>
            <div id="googleScholarField" class="hidden mt-2">
                <label class="block text-gray-300">Google Scholar URL</label>
                <input type="url" name="google_scholar" value="{{ $user->google_scholar }}" class="w-full px-4 py-2 border rounded bg-gray-800 text-white">
            </div>
        </div>

        <div class="mt-4">
            <button type="button" onclick="toggleLinkField('githubField')" class="bg-blue-600 text-white px-3 py-1 rounded">Add GitHub</button>
            <div id="githubField" class="hidden mt-2">
                <label class="block text-gray-300">GitHub URL</label>
                <input type="url" name="github" value="{{ $user->github }}" class="w-full px-4 py-2 border rounded bg-gray-800 text-white">
            </div>
        </div>

        <script>
            function toggleLinkField(fieldId) {
                const field = document.getElementById(fieldId);
                field.classList.toggle('hidden');
            }
        </script>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
