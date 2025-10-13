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
        color: var(--text-dark);
    }

    .dark .post-card-title {
        color: var(--text-light);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .featured-post {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .featured-image-wrapper {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .post-header .post-title {
            font-size: 2rem;
        }

        .post-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .post-header .post-title {
            font-size: 1.5rem;
        }

        .post-content {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- ADVERTORIAL INTRO - Selalu Muncul -->
    <section style="text-align: center; margin: 3rem auto; max-width: 1200px; padding: 0 20px;">
        <h2 style="font-size: 2rem; font-weight: 700; color: #004c75; margin-bottom: 1rem;">Apa Itu Advertorial?</h2>
        <p style="max-width: 800px; margin: 0 auto; font-size: 1.1rem; color: #64748b; line-height: 1.8;">
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
                        <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                            class="post-card-image">
                        <div class="post-card-content">
                            <h3 class="post-card-title line-clamp-2">{{ $post->judul }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $otherPosts->links() }}
            </div>
        </section>
    @endif
@endsection
