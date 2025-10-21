@extends('layouts.frontend')

@section('title', $featuredPost->judul ?? 'Advertorial')

@push('styles')
<style>
    /* Main Content */
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 20px;
    }

    /* Featured Post Layout - Foto Kiri, Caption Kanan */
    .featured-post {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 3rem;
        align-items: start;
    }

    .featured-image-wrapper {
        position: sticky;
        top: 100px;
    }

    .post-image {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .featured-content-wrapper {
        padding: 20px 0;
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
        margin-bottom: 2rem;
    }

    .dark .post-header .post-meta {
        color: #9ca3af;
    }

    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .post-content a {
        color: var(--primary-color);
        text-decoration: underline;
        font-weight: 500;
    }

    .dark .post-content a {
        color: #fcd34d;
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
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px 16px;
        margin-top: 24px;
    }

    .post-card {
        background: transparent;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .post-card-thumbnail {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        border-radius: 12px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .dark .post-card-thumbnail {
        background: #2d2d2d;
    }

    .post-card-thumbnail img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }

    .post-card:hover .post-card-thumbnail img {
        transform: scale(1.05);
    }

    .post-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .post-card-content {
        padding: 12px 0 0 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .post-card-title {
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.4;
        color: #0f0f0f;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .dark .post-card-title {
        color: #f1f1f1;
    }

    .post-card:hover .post-card-title {
        color: #065fd4;
    }

    .dark .post-card:hover .post-card-title {
        color: #3ea6ff;
    }

    .post-card-meta {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #606060;
        font-size: 0.8rem;
    }

    .dark .post-card-meta {
        color: #aaaaaa;
    }

    .post-card-meta i {
        font-size: 0.75rem;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .container,
        .related-posts {
            padding: 20px 15px;
        }
    }

    @media (max-width: 1024px) {
        .featured-post {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .featured-image-wrapper {
            position: relative;
            top: 0;
        }

        .post-header .post-title {
            font-size: 2.2rem;
        }

        .post-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 18px 14px;
        }
    }

    @media (max-width: 768px) {
        .post-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 12px;
        }
        .container,
        .related-posts {
            padding: 15px 10px;
            margin: 1.5rem auto;
        }

        .advertorial-intro {
            margin: 2rem auto !important;
            padding: 0 15px !important;
        }

        .intro-title {
            font-size: 1.6rem !important;
        }

        .intro-text {
            font-size: 1rem !important;
        }

        .post-header .post-title {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .post-image {
            max-height: 400px;
        }

        .featured-content-wrapper {
            padding: 10px 0;
        }
    }

    @media (max-width: 480px) {
        .post-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .container,
        .related-posts {
            padding: 10px 8px;
            margin: 1rem auto;
        }

        .advertorial-intro {
            margin: 1.5rem auto !important;
            padding: 0 10px !important;
        }

        .intro-title {
            font-size: 1.4rem !important;
        }

        .intro-text {
            font-size: 0.95rem !important;
        }

        .post-header .post-title {
            font-size: 1.4rem;
            margin-bottom: 0.75rem;
        }

        .post-header .category {
            font-size: 0.75rem;
            padding: 3px 10px;
        }

        .post-header .post-meta {
            font-size: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .post-content {
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .post-image {
            max-height: 300px;
            border-radius: 8px;
        }

        .post-card-content {
            padding: 10px 0 0 0;
        }

        .post-card-title {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 360px) {
        .container,
        .related-posts {
            padding: 8px 5px;
        }

        .advertorial-intro {
            margin: 1rem auto !important;
            padding: 0 8px !important;
        }

        .intro-title {
            font-size: 1.2rem !important;
        }

        .intro-text {
            font-size: 0.85rem !important;
        }

        .post-header .post-title {
            font-size: 1.2rem;
        }

        .post-content {
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .post-image {
            max-height: 250px;
        }

        .post-card-content {
            padding: 8px 0 0 0;
        }

        .post-card-title {
            font-size: 0.85rem;
        }

        .post-card-thumbnail {
            border-radius: 8px;
        }
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
        justify-content: center;
        align-items: center;
    }

    .pagination li {
        margin: 0;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #374151;
    }

    .dark .pagination a,
    .dark .pagination span {
        background: #1f2937;
        border-color: #374151;
        color: #d1d5db;
    }

    .pagination a:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dark .pagination a:hover {
        background: #374151;
        border-color: #4b5563;
    }

    .pagination .active span {
        background: #065fd4;
        border-color: #065fd4;
        color: #ffffff;
        font-weight: 600;
    }

    .dark .pagination .active span {
        background: #3ea6ff;
        border-color: #3ea6ff;
        color: #000000;
    }

    .pagination .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f9fafb;
    }

    .dark .pagination .disabled span {
        background: #111827;
    }

    /* Pagination arrows */
    .pagination a[rel="prev"],
    .pagination a[rel="next"] {
        font-weight: 600;
    }

    .pagination a[rel="prev"]:hover,
    .pagination a[rel="next"]:hover {
        background: #065fd4;
        border-color: #065fd4;
        color: #ffffff;
    }

    .dark .pagination a[rel="prev"]:hover,
    .dark .pagination a[rel="next"]:hover {
        background: #3ea6ff;
        border-color: #3ea6ff;
        color: #000000;
    }
</style>
@endpush

@section('content')
    <!-- ADVERTORIAL INTRO - Selalu Muncul -->
    <section class="advertorial-intro" style="text-align: center; margin: 3rem auto; max-width: 1200px; padding: 0 20px;">
        <h2 class="intro-title" style="font-size: 2rem; font-weight: 700; color: #004c75; margin-bottom: 1rem;">Apa Itu Advertorial?</h2>
        <p class="intro-text" style="max-width: 800px; margin: 0 auto; font-size: 1.1rem; color: #64748b; line-height: 1.8;">
            Advertorial adalah bentuk konten pemasaran yang menggabungkan unsur editorial dengan promosi produk atau layanan.
            Dibuat dengan gaya jurnalistik yang informatif, advertorial memberikan nilai tambah bagi pembaca sambil
            mempromosikan brand Anda secara halus dan efektif.
        </p>
    </section>

    @if ($featuredPost)
        <!-- Jika ada konten yang dipilih, tampilkan detail -->
        <main class="container">
            <article class="featured-post">
                <!-- Foto di Kiri -->
                <div class="featured-image-wrapper">
                    <img src="{{ asset('storage/' . $featuredPost->gambar) }}" alt="{{ $featuredPost->judul }}"
                        class="post-image">
                </div>

                <!-- Caption di Kanan -->
                <div class="featured-content-wrapper">
                    <header class="post-header">
                        <span class="category">Advertorial</span>
                        <h1 class="post-title">{{ $featuredPost->judul }}</h1>
                        <p class="post-meta">
                            Dipublikasikan pada
                            {{ \Carbon\Carbon::parse($featuredPost->tanggal)->isoFormat('D MMMM YYYY') }}
                        </p>
                    </header>

                    <div class="post-content prose dark:prose-invert max-w-none">
                        {!! $featuredPost->caption !!}
                    </div>
                </div>
            </article>
        </main>
    @endif

    @if ($otherPosts->isNotEmpty())
        <section class="related-posts">
            <h2 class="section-title">{{ $featuredPost ? 'Baca Juga' : 'Semua Advertorial' }}</h2>
            <div class="post-grid">
                @foreach ($otherPosts as $post)
                    <a href="{{ route('advertorial.page', ['post' => $post->id]) }}" class="post-card">
                        <div class="post-card-thumbnail">
                            <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                                class="post-card-image">
                        </div>
                        <div class="post-card-content">
                            <h3 class="post-card-title">{{ $post->judul }}</h3>
                            <div class="post-card-meta">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($post->tanggal)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            {{ $otherPosts->links('vendor.pagination.custom') }}
        </section>
    @endif
@endsection
