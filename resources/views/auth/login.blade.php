<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Reservasi Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#E53935',
                        darkred: '#B71C1C',
                        lightred: '#FFEBEE',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 min-h-[600px] max-h-[95vh]">
        
        <!-- Left Side - Carousel -->
        <div class="relative bg-gradient-to-br from-red-600 via-red-700 to-red-900 p-6 sm:p-8 lg:p-12 flex items-center justify-center overflow-hidden order-2 lg:order-1">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-48 h-48 sm:w-72 sm:h-72 bg-red-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 sm:w-72 sm:h-72 bg-red-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 sm:w-72 sm:h-72 bg-red-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
            
            <!-- Carousel Content -->
            <div class="relative z-10 w-full max-w-lg mx-auto">
                <div id="carousel" class="transition-all duration-500">
                    <!-- Slide 1 -->
                    <div class="carousel-slide animate-fadeIn">
                        <div class="flex flex-col items-center text-center space-y-4 sm:space-y-6">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white">Reservasi Cepat</h3>
                            <p class="text-red-100 text-base sm:text-lg leading-relaxed px-2 sm:px-4">
                                Booking ruangan meeting dalam hitungan detik. Sistem terintegrasi untuk efisiensi maksimal.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="carousel-slide hidden">
                        <div class="flex flex-col items-center text-center space-y-4 sm:space-y-6">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white">Manajemen Terpusat</h3>
                            <p class="text-red-100 text-base sm:text-lg leading-relaxed px-2 sm:px-4">
                                Kelola semua ruangan dari satu platform. Real-time availability untuk seluruh gedung.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="carousel-slide hidden">
                        <div class="flex flex-col items-center text-center space-y-4 sm:space-y-6">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white">Keamanan Terjamin</h3>
                            <p class="text-red-100 text-base sm:text-lg leading-relaxed px-2 sm:px-4">
                                Data terlindungi dengan enkripsi tingkat enterprise. Akses terkontrol untuk setiap karyawan.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Slide 4 -->
                    <div class="carousel-slide hidden">
                        <div class="flex flex-col items-center text-center space-y-4 sm:space-y-6">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white">Performa Optimal</h3>
                            <p class="text-red-100 text-base sm:text-lg leading-relaxed px-2 sm:px-4">
                                Interface responsif dan cepat. Dirancang untuk produktivitas tim yang lebih baik.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Indicators -->
                <div class="flex justify-center space-x-2 mt-6 sm:mt-8">
                    <button class="carousel-indicator w-2 h-2 rounded-full bg-white transition-all duration-300" data-slide="0"></button>
                    <button class="carousel-indicator w-2 h-2 rounded-full bg-white/40 transition-all duration-300" data-slide="1"></button>
                    <button class="carousel-indicator w-2 h-2 rounded-full bg-white/40 transition-all duration-300" data-slide="2"></button>
                    <button class="carousel-indicator w-2 h-2 rounded-full bg-white/40 transition-all duration-300" data-slide="3"></button>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="p-6 sm:p-8 lg:p-12 flex flex-col justify-center bg-white order-1 lg:order-2">
            <div class="w-full max-w-md mx-auto">
                <!-- Logo -->
                <div class="flex justify-center mb-8 sm:mb-10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-red-600 to-red-700 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold text-gray-900">
                            Meet<span class="text-red-600">Tech</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8 sm:mb-10 text-center">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">Selamat Datang</h1>
                    <p class="text-gray-500 text-sm font-light">Masuk ke akun karyawan Anda</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="block text-gray-700 text-sm font-semibold tracking-wide">EMAIL</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                class="w-full pl-10 pr-4 py-3.5 text-sm sm:text-base border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 bg-gray-50 hover:bg-white" 
                                placeholder="nama@perusahaan.com"
                                required
                                autocomplete="email">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-gray-700 text-sm font-semibold tracking-wide">PASSWORD</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                class="w-full pl-10 pr-4 py-3.5 text-sm sm:text-base border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 bg-gray-50 hover:bg-white" 
                                placeholder="••••••••"
                                required
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 rounded focus:ring-red-500 border-gray-300">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">
                            Lupa password?
                        </a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-4 px-4 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg active:scale-[0.98] tracking-wide text-sm sm:text-base shadow-md">
                        MASUK KE SISTEM
                    </button>
                </form>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-500">
                        Belum punya akses? 
                        <a href="#" class="text-red-600 hover:text-red-700 font-medium transition-colors">Hubungi administrator</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Reset and base styles */
    html, body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        height: 100%;
    }

    /* Ensure the main container takes full viewport */
    .min-h-screen {
        min-height: 100vh;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Main card container */
    .max-w-6xl {
        height: auto;
        max-height: 95vh;
        min-height: 600px;
    }

    /* Grid layout adjustments */
    .grid {
        height: 100%;
    }

    /* Individual column adjustments */
    .grid > div {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Carousel side specific adjustments */
    .order-2.lg\:order-1 {
        min-height: 300px;
        height: 100%;
    }

    /* Login form side specific adjustments */
    .order-1.lg\:order-2 {
        min-height: 500px;
        height: 100%;
        overflow-y: auto;
    }

    /* Ensure form container is properly centered */
    .max-w-md {
        width: 100%;
        padding: 1rem 0;
    }

    /* Animation styles */
    @keyframes blob {
        0%, 100% { 
            transform: translate(0, 0) scale(1); 
        }
        33% { 
            transform: translate(30px, -50px) scale(1.1); 
        }
        66% { 
            transform: translate(-20px, 20px) scale(0.9); 
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(10px);
        }
        to { 
            opacity: 1; 
            transform: translateY(0);
        }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out forwards;
    }

    /* Responsive adjustments */
    @media (max-height: 700px) {
        .max-w-6xl {
            min-height: 550px;
            max-height: 90vh;
        }
        
        .order-1.lg\:order-2 {
            min-height: 450px;
        }
    }

    @media (max-width: 1024px) {
        .max-w-6xl {
            height: auto;
            min-height: auto;
            max-height: 90vh;
        }
        
        .grid > div {
            min-height: auto;
        }
        
        .order-2.lg\:order-1 {
            min-height: 300px;
        }
        
        .order-1.lg\:order-2 {
            min-height: 400px;
        }
    }

    @media (max-width: 640px) {
        .min-h-screen {
            padding: 0.5rem;
        }
        
        .max-w-6xl {
            max-height: 95vh;
        }
        
        .order-1.lg\:order-2 {
            min-height: 450px;
        }
    }

    /* Very small screens */
    @media (max-height: 600px) {
        .min-h-screen {
            align-items: flex-start;
            padding-top: 1rem;
        }
        
        .max-w-6xl {
            max-height: 95vh;
        }
    }
</style>

<script>
    // Carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const totalSlides = slides.length;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden');
                    slide.classList.add('animate-fadeIn');
                    setTimeout(() => {
                        slide.classList.remove('animate-fadeIn');
                    }, 500);
                } else {
                    slide.classList.add('hidden');
                }
            });
            
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.remove('bg-white/40', 'w-2');
                    indicator.classList.add('bg-white', 'w-6');
                } else {
                    indicator.classList.remove('bg-white', 'w-6');
                    indicator.classList.add('bg-white/40', 'w-2');
                }
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }
        
        // Auto slide every 5 seconds
        let autoSlide = setInterval(nextSlide, 5000);
        
        // Manual navigation
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
                // Reset auto slide timer
                clearInterval(autoSlide);
                autoSlide = setInterval(nextSlide, 5000);
            });
        });
        
        // Initialize
        showSlide(0);

        // Form submission loading state
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...</span>';
                    submitBtn.disabled = true;
                }
            });
        }

        // Adjust layout on window resize
        function adjustLayout() {
            const viewportHeight = window.innerHeight;
            const mainCard = document.querySelector('.max-w-6xl');
            
            if (viewportHeight < 700) {
                mainCard.style.maxHeight = '90vh';
                mainCard.style.minHeight = '550px';
            } else {
                mainCard.style.maxHeight = '95vh';
                mainCard.style.minHeight = '600px';
            }
        }

        // Initial adjustment
        adjustLayout();
        
        // Adjust on resize
        window.addEventListener('resize', adjustLayout);
    });

    // Prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>
</html>