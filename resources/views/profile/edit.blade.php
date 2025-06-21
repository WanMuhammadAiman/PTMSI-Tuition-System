<x-app-layout>
    <div class="py-16 px-4 md:px-12 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- 1. Profile Picture --}}
                <div class="bg-white bg-opacity-95 backdrop-blur-lg p-6 rounded-2xl shadow-md text-center flex flex-col items-center mt-10">
                    <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="flex flex-col items-center">
                        @csrf
                        @method('PATCH')

                        {{-- Profile Image --}}
                        <img
                            src="{{ $user->profile_photo_path && file_exists(public_path('storage/' . $user->profile_photo_path)) 
                                ? asset('storage/' . $user->profile_photo_path) 
                                : asset('images/default-avatar.png') }}"
                            class="w-32 h-32 rounded-full object-cover border-4 border-yellow-400 shadow-md"
                            alt="Profile Photo">

                        {{-- Hidden File Input --}}
                        <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*" onchange="this.form.submit()">

                        {{-- Button --}}
                        <label for="profile_photo" class="inline-flex items-center justify-center px-6 py-2 mt-4 text-sm font-semibold text-black bg-yellow-400 rounded-md shadow-md hover:bg-yellow-500 transition-colors duration-200 cursor-pointer">
                            Change Profile Photo
                        </label>

                        @error('profile_photo')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </form>

                    {{-- User Info --}}
                    <div class="mt-6 text-center w-full">
                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        
                        {{-- School Information --}}
                        <div class="mt-4 bg-blue-50 rounded-lg p-3 border border-blue-100">
                            <div class="flex items-center justify-center space-x-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="font-medium text-blue-800">Education</span>
                            </div>
                            
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between px-2">
                                    <span class="text-gray-600">Level:</span>
                                    <span class="font-medium text-gray-800">{{ $user->level ?? 'Not specified' }}</span>
                                </div>
                                <div class="flex justify-between px-2">
                                    <span class="text-gray-600">Form:</span>
                                    <span class="font-medium text-gray-800">{{ $user->form ?? 'Not specified' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Account Information --}}
                <div class="bg-white bg-opacity-95 backdrop-blur-lg p-6 rounded-2xl shadow-md mt-10">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- 3. Password + Delete --}}
                <div class="bg-white bg-opacity-95 backdrop-blur-lg p-6 rounded-2xl shadow-md flex flex-col gap-8 mt-10">
                    <div>
                        <h3 class="-mt-3 text-lg font-semibold text-gray-800 -mb-4">Reset Password</h3>
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="pt-4 border-t">
                        <h3 class="text-lg font-semibold text-red-600 mb-2">Delete Account</h3>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>