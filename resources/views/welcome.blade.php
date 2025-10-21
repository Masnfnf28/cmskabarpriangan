@extends('layouts.frontend')

@section('title', 'Beranda')

@push('styles')
<style>
    /* Top Section with Slideshow and Trending */
    .top-section {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    @media (min-width: 768px) {
        .top-section {
            grid-template-columns: 2fr 1fr;
        }
    }

    /* Slideshow */
    .slideshow-container {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
    }

    .mySlides {
        display: none;
    }

    .mySlides img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        background-color: #000;
    }

    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: background-color 0.3s ease;
        border-radius: 50%;
        user-select: none;
        background: rgba(0, 0, 0, 0.3);
    }

    .prev {
        left: 15px;
    }

    .next {
        right: 15px;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.6);
    }

    .text {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 700;
        padding: 20px;
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: left;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .dot {
        cursor: pointer;
        height: 10px;
        width: 10px;
        margin: 0 4px;
        background-color: #ccc;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.3s;
    }

    .dot.active,
    .dot:hover {
        background-color: var(--secondary-color);
        transform: scale(1.2);
    }

    .fade {
        animation: fade 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* Main Layout */
    .main-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }

    /* Sidebar */
    .sidebar {
        background: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        height: fit-content;
    }

    .dark .sidebar {
        background: #1f2937;
    }

    .sidebar .trending-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--secondary-color);
        border-bottom: 2px solid var(--secondary-color);
        padding-bottom: 4px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .trending-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
    }

    .dark .trending-item {
        border-color: #374151;
    }

    .trending-item:last-child {
        border-bottom: none;
    }

    .trending-number {
        color: #9ca3af;
        font-weight: 700;
        font-size: 1rem;
        line-height: 1;
        min-width: 30px;
        text-align: center;
        flex-shrink: 0;
    }

    .trending-item > div:nth-child(2) {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .trending-link {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.3s;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dark .trending-link {
        color: var(--text-light);
    }

    .trending-link:hover {
        color: var(--secondary-color);
    }

    .trending-views {
        color: #6b7280;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dark .trending-views {
        color: #9ca3af;
    }

    .trending-views i {
        font-size: 0.7rem;
    }

    /* Post Grid */
    .post-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px 16px;
        margin-top: 24px;
    }

    .post-card {
        background: transparent;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: all 0.2s ease;
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

    .post-card-content {
        padding: 12px 0 0 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .post-title {
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

    .dark .post-title {
        color: #f1f1f1;
    }

    .post-card:hover .post-title {
        color: #065fd4;
    }

    .dark .post-card:hover .post-title {
        color: #3ea6ff;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #606060;
        font-size: 0.8rem;
    }

    .dark .post-meta {
        color: #aaaaaa;
    }

    .post-meta i {
        font-size: 0.75rem;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .top-section,
        .main-container {
            max-width: 100%;
            padding: 0 20px;
        }

        .post-grid {
            gap: 18px 14px;
        }
    }

    @media (max-width: 1024px) {
        .post-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 18px 14px;
        }

        .top-section {
            gap: 25px;
        }

        .mySlides img {
            height: 380px;
        }

        .section-title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 768px) {
        .top-section {
            margin: 1rem auto;
            padding: 0 10px;
            gap: 20px;
        }

        .mySlides img {
            height: 320px;
        }

        .post-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 12px;
        }

        .text {
            font-size: 1.1rem;
            padding: 15px;
        }

        .prev,
        .next {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }

        .main-container {
            margin: 1rem auto;
            padding: 0 10px;
            gap: 30px;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .sidebar {
            margin-top: 20px;
        }

        .trending-title {
            font-size: 1rem;
        }

        .trending-number {
            font-size: 1rem;
            min-width: 25px;
        }
    }

    @media (max-width: 480px) {
        .top-section,
        .main-container {
            padding: 0 8px;
        }

        .mySlides img {
            height: 260px;
        }

        .post-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .text {
            font-size: 0.95rem;
            padding: 10px;
        }

        .prev,
        .next {
            width: 30px;
            height: 30px;
            font-size: 14px;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .post-title {
            font-size: 0.95rem;
        }

        .post-meta {
            font-size: 0.75rem;
        }

        .trending-link {
            font-size: 0.85rem;
        }

        .trending-number {
            font-size: 0.9rem;
            min-width: 20px;
        }

        .sidebar {
            padding: 15px;
        }

        .post-card-content {
            padding: 10px 0 0 0;
        }

        .post-title {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 360px) {
        .top-section,
        .main-container {
            padding: 0 5px;
            margin: 0.75rem auto;
        }

        .mySlides img {
            height: 220px;
        }

        .text {
            font-size: 0.85rem;
            padding: 8px;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .post-title {
            font-size: 0.9rem;
        }

        .trending-link {
            font-size: 0.8rem;
        }

        .trending-title {
            font-size: 0.9rem;
        }

        .sidebar {
            padding: 12px;
        }

        .dot {
            height: 8px;
            width: 8px;
            margin: 0 3px;
        }

        .post-card-content {
            padding: 8px 0 0 0;
        }

        .post-title {
            font-size: 0.85rem;
        }

        .post-card-thumbnail {
            border-radius: 8px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Top Section: Slideshow & Trending -->
    <div class="top-section">
        <!-- Slideshow -->
        <div>
            @if ($konten && count($konten) > 0)
                <div class="slideshow-container" data-aos="fade-right">
                    @foreach (collect($konten)->take(3) as $k)
                        <div class="mySlides fade">
                            <a href="{{ route('advertorial.page', ['post' => $k->id]) }}">
                                <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}">
                                <div class="text">{{ $k->judul }}</div>
                            </a>
                        </div>
                    @endforeach
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <div style="text-align:center; margin-top: 1rem;">
                    @foreach (collect($konten)->take(3) as $item)
                        <span class="dot" onclick="currentSlide({{ $loop->iteration }})"></span>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Trending Sidebar -->
        <aside class="sidebar" data-aos="fade-left">
            <h3 class="trending-title">TRENDING</h3>
            @forelse ($trending as $k)
                <div class="trending-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="trending-number">{{ $loop->iteration }}</div>
                    <div>
                        <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="trending-link"
                            data-title="{{ $k->judul }}">
                            {{ $k->judul }}
                        </a>
                        <div class="trending-views">
                            <i class="fas fa-eye"></i> {{ number_format($k->views) }} views
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada konten trending.</p>
            @endforelse
        </aside>
    </div>

    <!-- Main Content: Postingan Terbaru -->
    <main class="main-container">
        <section class="content-main">
            <h2 class="section-title" data-aos="fade-right">Postingan Terbaru</h2>
            <div class="post-grid">
                @forelse ($konten as $k)
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="post-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="post-card-thumbnail">
                            <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}">
                        </div>
                        <div class="post-card-content">
                            <h2 class="post-title">{{ $k->judul }}</h2>
                            <div class="post-meta">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center py-10 text-gray-500">Tidak ada postingan yang dapat ditampilkan.
                    </p>
                @endforelse
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
    // Slideshow functionality
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (slides.length === 0) return;
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
    setInterval(() => {
        plusSlides(1);
    }, 5000);
</script>
@endpush
