<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="pb-2">
        @csrf

        <!-- Name -->
        <div>
            <div style="display:flex;">
                <x-input-label for="name" :value="__('Name')"/><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <div style="display:flex;">
                <x-input-label for="email" :value="__('Email')" /><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Index Number -->
        <div class="mt-2">
            <x-input-label for="indexNo" :value="__('IndexNo')" />
            <x-text-input id="indexNo" class="block mt-1 w-full" type="text" name="indexNo" :value="old('indexNo')" autocomplete="indexNo"  placeholder="Ex: 2021XXX001"/>
            <x-input-error :messages="$errors->get('indexNo')" class="mt-2" />
        </div>


        <!-- NIC -->
        <div class="mt-2">
            <div style="display:flex;">
                <x-input-label for="nic" :value="__('Nic')" /><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required autocomplete="nic" placeholder="Nic"/>
            <x-input-error :messages="$errors->get('nic')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <div style="display:flex;">
                <x-input-label for="password" :value="__('Password')" /><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"  placeholder="Password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <div style="display:flex;">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"  placeholder="Reenter-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Selector -->
        <div class="mt-2">
            <div style="display:flex;">
                <x-input-label for="role" :value="__('Role')" class="text-gray-200" /><span style="color:#ff4278;">&nbsp;*</span>
            </div>
            <select id="role" name="role" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-gray-500 focus:ring-gray-500" required>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                <option value="lecturer" {{ old('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-gray-400" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-2">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
