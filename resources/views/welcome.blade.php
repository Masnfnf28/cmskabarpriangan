@extends('layouts.frontend')

@section('title', 'Beranda')

@push('styles')
<style>
    /* Slideshow */
    .slideshow-container {
        max-width: 1200px;
        position: relative;
        margin: 2rem auto;
        border-radius: 8px;
        overflow: hidden;
    }

    .mySlides {
        display: none;
    }

    .mySlides img {
        width: 100%;
        height: 350px;
        object-fit: cover;
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
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
    }

    @media (min-width: 1024px) {
        .main-container {
            grid-template-columns: 3fr 1fr;
        }
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
    .sidebar .trending-title {
        font-size: 1.2rem;
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
        font-size: 1.5rem;
        line-height: 1;
        min-width: 30px;
        text-align: center;
    }

    .trending-link {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .dark .trending-link {
        color: var(--text-light);
    }

    .trending-link:hover {
        color: var(--secondary-color);
    }

    /* Post Grid */
    .post-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .post-card {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .dark .post-card {
        background: #1f2937;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .post-card-content {
        padding: 1rem;
    }

    .post-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #6b7280;
        font-size: 0.8rem;
    }

    .dark .post-meta {
        color: #9ca3af;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .slideshow-container {
            margin: 1rem;
        }

        .mySlides img {
            height: 250px;
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

        .post-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .sidebar {
            margin-top: 20px;
        }

        .trending-title {
            font-size: 1.1rem;
        }

        .trending-number {
            font-size: 1.2rem;
            min-width: 25px;
        }
    }

    @media (max-width: 480px) {
        .mySlides img {
            height: 200px;
        }

        .text {
            font-size: 1rem;
            padding: 10px;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .post-title {
            font-size: 1rem;
        }

        .post-meta {
            font-size: 0.75rem;
        }

        .trending-link {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
    @if ($konten && count($konten) > 0)
        <div class="slideshow-container">
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

    <main class="main-container">
        <section class="content-main">
            <h2 class="section-title">Postingan Terbaru</h2>
            <div class="post-grid">
                @forelse ($konten as $k)
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="post-card">
                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}"
                            class="w-full h-40 object-cover">
                        <div class="post-card-content">
                            <h3 class="post-title line-clamp-2">{{ $k->judul }}</h3>
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

        <aside class="sidebar">
            <h3 class="trending-title">TRENDING</h3>
            @forelse (collect($konten)->take(6) as $k)
                <div class="trending-item">
                    <div class="trending-number">{{ $loop->iteration }}</div>
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="trending-link"
                        data-title="{{ $k->judul }}">
                        {{ $k->judul }}
                    </a>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada konten trending.</p>
            @endforelse
        </aside>
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
