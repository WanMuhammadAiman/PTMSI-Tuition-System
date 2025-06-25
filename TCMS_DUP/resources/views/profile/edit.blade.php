<x-app-layout>

    <div class="py-16 px-4 md:px-12 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- 1. Profile Picture -->
                <div class="bg-white bg-opacity-95 backdrop-blur-lg p-6 rounded-2xl shadow-md text-center flex flex-col items-center mt-10">
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}"
                    class="w-32 h-32 rounded-full object-cover border-4 border-yellow-400 shadow-md"
                    alt="Profile Photo">

                    <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <!-- File input -->
</form>

    @csrf
    @method('PATCH')

    <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*" onchange="this.form.submit()">

    <label for="profile_photo" class="inline-flex items-center justify-center px-6 py-2 mt-2 text-sm font-semibold text-black bg-yellow-400 rounded-md shadow-md hover:bg-yellow-500 transition-colors duration-200">
        Change Profile Photo
    </label>

    @error('profile_photo')
        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
    @enderror
</form>

                    <div class="mt-6 text-center">
    <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
    <p class="text-sm text-gray-600">{{ $user->email }}</p>


</div>
                </div>

                <!-- 2. Profile Info -->
                <div class="bg-white bg-opacity-95 backdrop-blur-lg p-6 rounded-2xl shadow-md mt-10">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- 3. Password + Delete -->
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
