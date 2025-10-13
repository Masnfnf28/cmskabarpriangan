<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PRIANGAN TV') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- CSS Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- TinyMCE Script dengan API Key Anda --}}
    <script src="https://cdn.tiny.cloud/1/sa3z3p4epveoexl0yk9zrazjuh2fj6gvsl2rfqr1ch96r341/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <!-- Scripts Laravel (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Stack untuk custom styles dari halaman lain --}}
    @stack('styles')

    {{-- Custom CSS untuk Select2 agar sesuai tema --}}
    <style>
        /* General styling for Select2 container */
        .select2-container .select2-selection--single {
            width: 100% !important;
            background-color: #f9fafb; /* bg-gray-50 */
            border: 1px solid #d1d5db !important; /* border-gray-300 */
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            height: 43px;
            border-radius: 0.4rem;
            color: #1f2937; /* text-gray-800 */
        }
        /* Dark mode styling for Select2 */
        .dark .select2-container .select2-selection--single {
            background-color: #374151; /* dark:bg-gray-700 */
            border-color: #4b5563 !important; /* dark:border-gray-600 */
            color: #f9fafb; /* dark:text-gray-50 */
        }
        .dark .select2-selection__rendered {
            color: #f9fafb !important; /* dark:text-gray-50 */
        }
        /* Dropdown styling */
        .select2-container--open .select2-dropdown {
            background-color: #fff;
            border: 1px solid #d1d5db;
        }
        .dark .select2-container--open .select2-dropdown {
            background-color: #1f2937; /* dark:bg-gray-800 */
            border-color: #4b5563; /* dark:border-gray-600 */
        }
        .dark .select2-results__option {
            color: #f9fafb; /* dark:text-gray-50 */
        }
        .dark .select2-search__field {
            background-color: #374151; /* dark:bg-gray-700 */
            color: #f9fafb; /* dark:text-gray-50 */
        }
        /* Arrow and text positioning */
        .select2-container .select2-selection--single .select2-selection__arrow {
            top: 20% !important;
            right: 8px;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            font-size: 14px !important;
            top: -2px;
            left: -6px;
            position: relative;
            color: #1f2937;
        }
        
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @if(isset($slot))
                <div class="px-3 py-3">
                    {{ $slot }}
                </div>
            @else
                @yield('content')
            @endif
        </main>
    </div>

    {{-- Bagian Script di Akhir Body untuk performa lebih baik --}}
    
    {{-- Jquery (diperlukan oleh Select2) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Inisialisasi Umum untuk Select2 --}}
    <script>
        $(document).ready(function() {
            // Inisialisasi semua elemen dengan kelas ini
            $(".js-example-placeholder-single").select2({
                placeholder: "Pilih...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    
    {{-- Tempat untuk script dari halaman lain (seperti inisialisasi TinyMCE) --}}
    @stack('scripts')
</body>
</html>

