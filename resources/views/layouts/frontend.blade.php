<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Priangan TV')</title>
    <link rel="icon" href="{{ asset('faviconremove.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Kode CSS untuk Tampilan Frontend --}}
    <style>
        :root {
            --primary-color: #fca311;
            --secondary-color: #004c75;
            --text-dark: #1f2937;
            --text-light: #f9fafb;
            --bg-light: #ffffff;
            --bg-dark: #111827;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .dark body {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }

        /* Navigasi */
        .main-nav {
            background-color: #fca311;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        .nav-logo img {
            height: 45px;
            width: auto;
        }

        .nav-links a {
            margin-left: 1.5rem;
            text-decoration: none;
            color: #000000;
            font-weight: 600;
            transition: color 0.3s;
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
        }

        .nav-links a:hover {
            color: #000000;
            border-bottom-color: #000000;
        }

        /* Hamburger Menu */
        .hamburger-menu {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger-menu span {
            width: 25px;
            height: 3px;
            background-color: #000000;
            transition: all 0.3s ease;
        }

        .hamburger-menu.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .hamburger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-menu.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Mobile Menu */
        .mobile-menu {
            position: absolute;
            top: 100%;
            right: 1rem;
            width: 250px;
            background-color: #fca311;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
            transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
            z-index: 50;
            padding: 0.75rem 0;
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-top: 0.5rem;
        }

        .mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu a {
            text-decoration: none;
            color: #000000;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            transition: all 0.3s;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        .mobile-menu a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #ffffff;
            padding-left: 1.5rem;
        }

        .mobile-menu a.active-page {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .desktop-nav {
                display: none !important;
            }

            .hamburger-menu {
                display: flex;
            }

            .main-nav {
                padding: 0.75rem 1rem;
            }

            .nav-container {
                padding: 0;
                height: 55px;
                position: relative;
            }

            .nav-logo img {
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .mobile-menu {
                width: 220px;
                right: 0.5rem;
            }
        }
    </style>

    <!-- Custom styles dari halaman individual -->
    @stack('styles')
</head>

<body class="antialiased text-gray-800 dark:text-gray-200">
    <!-- Navigation -->
    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-logo">
                <img src="{{ asset('images/logopriangantv.png') }}" alt="Priangan TV Logo">
            </a>
            <div class="nav-links desktop-nav">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ route('layanan-kami') }}">Layanan Kami</a>
                <a href="{{ route('advertorial.page') }}">Advertorial</a>
                <a href="{{ route('redaksi') }}">Redaksi</a>
                <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
            </div>
            <button class="hamburger-menu" id="hamburger-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="mobile-menu" id="mobile-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active-page' : '' }}">Beranda</a>
            <a href="{{ route('layanan-kami') }}" class="{{ request()->is('layanan-kami') ? 'active-page' : '' }}">Layanan Kami</a>
            <a href="{{ route('advertorial.page') }}" class="{{ request()->is('advertorial') || request()->is('advertorial/*') ? 'active-page' : '' }}">Advertorial</a>
            <a href="{{ route('redaksi') }}" class="{{ request()->is('redaksi') ? 'active-page' : '' }}">Redaksi</a>
            <a href="{{ route('tentang-kami') }}" class="{{ request()->is('tentang-kami') ? 'active-page' : '' }}">Tentang Kami</a>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer style="background-color: #004c75; color: white; margin-top: 4rem; padding: 3rem 2rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <!-- Footer Content Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; margin-bottom: 2rem;">

                <!-- About Section -->
                <div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; color: #fca311;">Priangan TV</h3>
                    <p style="line-height: 1.8; color: #e5e7eb; margin-bottom: 1rem;">
                        Media informasi terpercaya yang menyajikan berita terkini, advertorial, dan konten berkualitas untuk masyarakat Priangan.
                    </p>
                    <img src="{{ asset('images/logopriangantv.png') }}" alt="Priangan TV Logo" style="height: 50px; width: auto; margin-top: 1rem;">
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #fca311;">Menu</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ url('/') }}" style="color: #e5e7eb; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fca311'" onmouseout="this.style.color='#e5e7eb'">Beranda</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('layanan-kami') }}" style="color: #e5e7eb; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fca311'" onmouseout="this.style.color='#e5e7eb'">Layanan Kami</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('advertorial.page') }}" style="color: #e5e7eb; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fca311'" onmouseout="this.style.color='#e5e7eb'">Advertorial</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="#" style="color: #e5e7eb; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fca311'" onmouseout="this.style.color='#e5e7eb'">Tentang Kami</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #fca311;">Kontak</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; color: #e5e7eb; line-height: 1.8;">
                        <li style="margin-bottom: 0.75rem; display: flex; align-items: start; gap: 0.5rem;">
                            <span>📧</span>
                            <span>priangantv2024@gmail.com</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; display: flex; align-items: start; gap: 0.5rem;">
                            <span>📱</span>
                            <span>-</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; display: flex; align-items: start; gap: 0.5rem;">
                            <span>📍</span>
                            <span>Jl. dr. Soekarjo Nomor 70 Kelurahan Tawangsari Kecamatan Tawang Kota Tasikmalaya Jawa Barat (HU. Kabar Priangan)</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #fca311;">Ikuti Kami</h4>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="https://www.facebook.com/profile.php?id=61569031711597
" style="width: 40px; height: 40px; background-color: #fca311; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #004c75; text-decoration: none; font-weight: bold; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/priangan_tv/" style="width: 40px; height: 40px; background-color: #fca311; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #004c75; text-decoration: none; font-weight: bold; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@priangantv1999" style="width: 40px; height: 40px; background-color: #fca311; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #004c75; text-decoration: none; font-weight: bold; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.tiktok.com/@priangan_tv" style="width: 40px; height: 40px; background-color: #fca311; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #004c75; text-decoration: none; font-weight: bold; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                    <p style="margin-top: 1.5rem; color: #e5e7eb; line-height: 1.6;">
                        Dapatkan update berita terbaru dan informasi menarik lainnya dari Priangan TV.
                    </p>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div style="border-top: 1px solid rgba(252, 163, 17, 0.3); padding-top: 1.5rem; text-align: center;">
                <p style="color: #e5e7eb; font-size: 0.9rem; margin: 0;">
                    &copy; {{ date('Y') }} <strong style="color: #fca311;">Priangan TV</strong>. All rights reserved. | Developed By Peserta KKI LP3I Tasikmalaya
                </p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Hamburger menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (hamburgerBtn && mobileMenu) {
                hamburgerBtn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mobileMenu.classList.toggle('active');
                });

                // Close mobile menu when clicking on a link
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        hamburgerBtn.classList.remove('active');
                        mobileMenu.classList.remove('active');
                    });
                });
            }
        });
    </script>

    <!-- Custom scripts dari halaman individual -->
    @stack('scripts')
</body>

</html>