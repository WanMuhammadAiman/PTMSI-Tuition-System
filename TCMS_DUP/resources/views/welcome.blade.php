<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to PTMSI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out both;
        }
        .animate-fade-in {
            animation: fade-in-up 1s ease-out both;
        }
    </style>
</head>
<body class="text-white font-serif bg-[#004AAD]">

    <!-- NAVIGATION BAR -->
    <header class="fixed top-0 left-0 w-full z-50 bg-[#003a8c] bg-opacity-90 backdrop-blur-sm shadow-md">
        <div class="w-full px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-yellow-400">Pusat Tuisyen Minda Sukses Intelek</h1>
            <nav class="space-x-8 text-base font-medium">
                <a href="#about" class="hover:text-yellow-300 transition duration-200">About</a>
                <a href="#why" class="hover:text-yellow-300 transition duration-200">Why Us</a>
                <a href="#tutors" class="hover:text-yellow-300 transition duration-200">Director</a>
                <a href="#gallery" class="hover:text-yellow-300 transition duration-200">Gallery</a>
            </nav>
        </div>
    </header>
<!-- HERO SECTION -->
    <!-- HERO SECTION -->
    <!-- <section class="relative h-screen bg-cover bg-center bg-no-repeat"
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-6xl font-extrabold text-yellow-400 mb-4">Welcome to PTMSI</h1>
            <img src="{{ asset('images/ptmsilogo.jpg') }}" class="w-36 h-auto mb-6 drop-shadow-xl" alt="PTMSI Logo">
            <p class="text-2xl text-white mb-2 font-semibold">Perak Branch</p>
            <p class="text-xl text-white mb-6">Nurturing A Culture of Scientific Excellence</p> -->

            <div class="flex gap-6">
    @auth
        @if(Auth::user()->role === 'student')
            <a href="{{ route('student.dashboard') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">Go to Student Dashboard</a>
        @elseif(Auth::user()->role === 'tutor')
            <a href="{{ route('tutor.dashboard') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">Go to Tutor Dashboard</a>
        @elseif(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">Go to Admin Dashboard</a>
        @else
            <a href="{{ url('/profile') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">My Profile</a>
        @endif
    @else
        <a href="{{ route('login') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">Login</a>
        <a href="{{ route('register') }}" class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-yellow-200 transition transform hover:scale-105">Enrol Now</a>
    @endauth
</div>


        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-20 px-6 md:px-20 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 transition duration-700 animate-fade-in">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6 text-yellow-600">About PTMSI</h2>
            <p class="text-lg mb-6">Since 2013, PTMSI has been helping students shine brighter — starting from a humble home setup to now running two vibrant branches in Perak and Selangor. With over 160 students and 17 passionate tutors, we’re here to make learning easier, smarter, and more accessible.</p>
            <p class="text-lg mb-8 font-medium-bold">Explore, enrol, and excel — all in one place with our brand-new online management system!</p>
            <img src="{{ asset('images/grouppic1.jpg') }}" class="rounded-lg shadow-lg w-full max-w-3xl mx-auto transform hover:scale-105 transition duration-300" alt="Tuition Center Classroom">
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section id="why" class="py-20 px-6 md:px-20 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 transition duration-700 animate-fade-in">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-12 text-yellow-600">Why Choose PTMSI?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">
                <div class="bg-white bg-opacity-60 p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1 ml-8 md:ml-16 flex items-start gap-3">
                    <span class="text-pink-600 text-2xl">✔️</span>
                    <span>Experienced and caring tutors</span>
                </div>
                <div class="bg-white bg-opacity-60 p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1 ml-8 md:ml-16 flex items-start gap-3">
                    <span class="text-pink-600 text-2xl">✔️</span>
                    <span>Personalized learning approach</span>
                </div>
                <div class="bg-white bg-opacity-60 p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1 ml-8 md:ml-16 flex items-start gap-3">
                    <span class="text-pink-600 text-2xl">✔️</span>
                    <span>Proven academic improvements</span>
                </div>
                <div class="bg-white bg-opacity-60 p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1 ml-8 md:ml-16 flex items-start gap-3">
                    <span class="text-pink-600 text-2xl">✔️</span>
                    <span>Affordable, effective programs</span>
                </div>
            </div>
        </div>
    </section>

    <!-- DIRECTOR SECTION -->
    <section id="tutors" class="py-20 px-6 md:px-20 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 transition duration-700 animate-fade-in">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold mb-12 text-center text-yellow-600">Meet Our Director</h2>
            <div class="flex flex-col md:flex-row items-center gap-10 bg-white bg-opacity-60 p-8 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/director.jpg') }}" class="rounded-full w-48 h-48 object-cover" alt="Director">
                <div>
                    <h3 class="text-2xl font-semibold text-yellow-800 mb-2">Mr. Pinagalan Gejandran</h3>
                    <p class="text-sm text-gray-700 mb-4">Founder & Director, PTMSI</p>
                    <p class="text-base leading-relaxed">
                        Say hello to Mr. Pingalan Gejandran — the heart and mind behind PTMSI.<br>
                        A passionate educator and the founder of PTMSI, Mr. Pingalan started this journey in 2013 with just one goal: to make learning meaningful and accessible for all. His dedication and vision continue to guide our center to greater heights every day.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section id="gallery" class="py-20 px-6 md:px-20 bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 text-gray-800 transition duration-700 animate-fade-in">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8 text-yellow-600">Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <img src="{{ asset('images/class1.jpg') }}" class="rounded-xl shadow-lg hover:scale-105 transition duration-300">
                <img src="{{ asset('images/class2.jpg') }}" class="rounded-xl shadow-lg hover:scale-105 transition duration-300">
                <img src="{{ asset('images/class3.jpg') }}" class="rounded-xl shadow-lg hover:scale-105 transition duration-300">
            </div>
        </div>
    </section>

</body>
</html>
