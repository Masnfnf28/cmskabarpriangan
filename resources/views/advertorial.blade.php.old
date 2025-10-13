<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $featuredPost->judul ?? 'Advertorial' }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        /* PERUBAHAN TEMA WARNA */
        :root {
            --primary-color: #fca311;
            /* Kuning sebagai warna utama */
            --secondary-color: #141E27;
            /* Biru Gelap/Hitam sebagai warna sekunder */
            --text-dark: #1f2937;
            --text-light: #f9fafb;
            --bg-light: #f9fafb;
            --bg-dark: #111827;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.7;
        }

        .dark body {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }

        /* Navigation Bar */
        .main-nav {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 3px solid var(--primary-color);
        }

        .dark .main-nav {
            background-color: #1f2937;
            /* gray-800 */
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--secondary-color);
        }

        .dark .nav-logo {
            color: var(--primary-color);
        }

        .nav-links a {
            margin-left: 1.5rem;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .dark .nav-links a {
            color: var(--text-light);
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Main Content */
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 20px;
        }

        .post-header .category {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .post-header .post-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .post-header .post-meta {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .dark .post-header .post-meta {
            color: #9ca3af;
        }

        .post-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .post-content {
            font-size: 1.1rem;
        }

        .post-content a {
            color: var(--primary-color);
            text-decoration: underline;
            font-weight: 500;
        }

        .dark .post-content a {
            color: #fcd34d;
            /* yellow-300 */
        }

        /* "Baca Juga" Section */
        .related-posts {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 20px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-color);
            display: inline-block;
            padding-bottom: 0.5rem;
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .post-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
        }

        .dark .post-card {
            background: #1f2937;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .post-card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .post-card-content {
            padding: 1rem;
        }

        .post-card-title {
            font-weight: 600;
            line-height: 1.4;
        }
    </style>
</head>

<body class="antialiased">
    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-logo">Portal Berita</a>
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('advertorial.page') }}">Advertorial</a>
                <a href="#">Kontak</a>
            </div>
        </div>
    </nav>

    <main class="container">
        @if ($featuredPost)
            <article>
                <header class="post-header">
                    <span class="category">Advertorial</span>
                    <h1 class="post-title">{{ $featuredPost->judul }}</h1>
                    <p class="post-meta">
                        Dipublikasikan pada
                        {{ \Carbon\Carbon::parse($featuredPost->tanggal)->isoFormat('D MMMM YYYY') }}
                    </p>
                </header>

                <img src="{{ asset('storage/' . $featuredPost->gambar) }}" alt="{{ $featuredPost->judul }}"
                    class="post-image">

                <div class="post-content prose dark:prose-invert max-w-none">
                    {!! $featuredPost->caption !!}
                </div>
            </article>
        @else
            <div class="text-center py-20">
                <h2 class="text-2xl font-semibold">Konten Tidak Ditemukan</h2>
                <p class="text-gray-500 mt-2">Maaf, konten yang Anda cari tidak tersedia.</p>
                <a href="{{ url('/') }}"
                    class="mt-6 inline-block bg-yellow-500 text-black px-6 py-2 rounded-lg hover:bg-yellow-600">Kembali
                    ke Home</a>
            </div>
        @endif
    </main>

    @if ($otherPosts->isNotEmpty())
        <section class="related-posts">
            <h2 class="section-title">Baca Juga</h2>
            <div class="post-grid">
                @foreach ($otherPosts as $post)
                    <a href="{{ route('advertorial.page', ['post' => $post->id]) }}" class="post-card">
                        <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                            class="post-card-image">
                        <div class="post-card-content">
                            <h3 class="post-card-title line-clamp-2">{{ $post->judul }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</body>

</html>
