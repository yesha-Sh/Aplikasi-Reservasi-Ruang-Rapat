<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Ruang Rapat</title>
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
                        bg: '#FAFAFA',
                        card: '#FFFFFF',
                        tech: '#F5F5F7'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'tech': '0 4px 14px 0 rgba(0, 0, 0, 0.08)',
                        'tech-lg': '0 10px 28px rgba(0, 0, 0, 0.08)',
                        'glow': '0 0 20px rgba(229, 57, 53, 0.15)'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .tech-border {
            border: 1px solid rgba(229, 57, 53, 0.1);
        }
        
        .glossy {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            backdrop-filter: blur(10px);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .tech-gradient {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%);
        }
        .red-glow:hover {
            box-shadow: 0 0 20px rgba(220, 38, 38, 0.3);
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #E53935 0%, #B71C1C 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(229, 57, 53, 0.3);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-tech text-gray-900 font-sans antialiased">

    <!-- Navigation -->
    <nav class="bg-white shadow-tech border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-lg"></i>
                </div>
                <div class="font-bold text-xl tracking-tight">
                    Reservasi<span class="text-primary"> Ruang Meeting</span>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-th-large mr-2 text-sm"></i> Dashboard
                    </a>
                    <a href="{{ route('reservations.history') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-history mr-2 text-sm"></i> Riwayat
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold text-sm hover:bg-darkred transition-all duration-200 flex items-center shadow-tech">
                            <i class="fas fa-cog mr-2"></i> Admin Area
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2 text-sm"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 pt-6">
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-tech flex items-center" role="alert">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 pt-6">
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg shadow-tech flex items-center" role="alert">
                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>