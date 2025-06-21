<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 font-serif flex flex-col items-center justify-center pt-4 pb-12 px-6">

        <!-- Registration Card -->
        <div class="w-full max-w-xl bg-white bg-opacity-90 backdrop-blur-lg p-10 rounded-3xl shadow-2xl transition-all duration-500 animate-fade-in-up mb-0">
            <!-- Logo Centered -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/ptmsilogo.jpg') }}" alt="PTMSI Logo" class="w-22 h-24 rounded-full shadow-lg">
            </div>

            <!-- Title & Description -->
            <h2 class="text-4xl font-extrabold text-center text-yellow-600 mb-2">Join PTMSI</h2>
            <p class="text-center text-gray-800 mb-8 text-base font-semibold">Create your account to become a part of  PTMSI now!</p>


            <!-- Role Selection -->
            <div class="flex justify-center gap-6 mb-8">
                <div onclick="selectRole('student')" id="student-card"
                     class="cursor-pointer border-2 border-blue-300 p-4 rounded-xl text-center w-36 transition-all duration-300 shadow-sm hover:shadow-lg hover:bg-yellow-100">
                    <img src="{{ asset('images/student.png') }}" alt="Student" class="mx-auto h-12 mb-2">
                    <p class="font-semibold text-sm text-gray-800">I'm a Student</p>
                </div>
                <div onclick="selectRole('tutor')" id="tutor-card"
                     class="cursor-pointer border-2 border-blue-300 p-4 rounded-xl text-center w-36 transition-all duration-300 shadow-sm hover:shadow-lg hover:bg-yellow-100">
                    <img src="{{ asset('images/tutor.png') }}" alt="Tutor" class="mx-auto h-12 mb-2">
                    <p class="font-semibold text-sm text-gray-800">I'm a Tutor</p>
                </div>
            </div>

            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
             </ul>
            </div>
            @endif

            
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input type="hidden" name="role" id="role" value="student">

                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-black font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-black font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-black font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                    type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-black font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-blue-700 hover:underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-xl shadow-md transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role').value = role;
            ['student-card', 'tutor-card'].forEach(id => {
                document.getElementById(id).classList.remove('bg-yellow-200', 'ring-2', 'ring-yellow-400');
            });
            document.getElementById(role + '-card').classList.add('bg-yellow-200', 'ring-2', 'ring-yellow-400');
        }
        window.onload = () => selectRole('student');
    </script>
</x-guest-layout>
