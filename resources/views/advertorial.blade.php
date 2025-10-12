@section('content')
    <main class="container">
        <!-- ADVERTORIAL INTRO -->
        <section class="advertorial-intro">
            <h2 class="section-title">Apa Itu Advertorial?</h2>
            <p class="intro-text">
                Advertorial adalah bentuk konten pemasaran yang menggabungkan unsur editorial dengan promosi produk atau
                layanan.
                Dibuat dengan gaya jurnalistik yang informatif, advertorial memberikan nilai tambah bagi pembaca sambil
                mempromosikan brand Anda secara halus dan efektif.
            </p>
        </section>

        <!-- FEATURED ADVERTORIAL - MENAMPILKAN POST YANG DIKLIK -->
        <section class="featured-advertorial" id="featured-advertorial">
            @if ($featuredPost)
                <div class="featured-card">
                    <img src="{{ asset('storage/' . $featuredPost->gambar) }}" alt="{{ $featuredPost->judul }}"
                        class="featured-image">
                    <div class="featured-content">
                        <span class="featured-badge">Featured</span>
                        <h2 class="featured-title">{{ $featuredPost->judul }}</h2>
                        <div class="featured-excerpt">
                            {!! $featuredPost->caption !!}
                        </div>
                        <div class="advertorial-meta">
                            <span
                                class="advertorial-date">{{ \Carbon\Carbon::parse($featuredPost->tanggal)->isoFormat('D MMMM YYYY') }}</span>
                            <div class="advertorial-views">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>{{ $featuredPost->views ?? '1.5K' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center py-10">Konten yang Anda cari tidak ditemukan atau belum ada.</p>
            @endif
        </section>

        <!-- ADVERTORIAL GRID -->
        <section class="advertorial-grid" id="advertorial-grid">
            @forelse ($otherPosts as $post)
                <div class="advertorial-card">
                    <a href="{{ route('advertorial.page', ['post' => $post->id]) }}" class="block">
                        <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                            class="advertorial-image">
                        <div class="advertorial-content">
                            <span class="advertorial-category">{{ $post->category ?? 'Berita' }}</span>
                            <h3 class="advertorial-title line-clamp-2">{{ $post->judul }}</h3>
                            <div class="advertorial-excerpt line-clamp-3">
                                {!! strip_tags($post->caption) !!}
                            </div>
                            <div class="advertorial-meta">
                                <span
                                    class="advertorial-date">{{ \Carbon\Carbon::parse($post->tanggal)->isoFormat('D MMMM YYYY') }}</span>
                                <div class="advertorial-views">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ $post->views ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="col-span-full text-center py-10">Tidak ada advertorial lain untuk ditampilkan.</p>
            @endforelse
        </section>

        <!-- PAGINATION -->
        <div class="pagination-container">
            {{ $otherPosts->links() }}
        </div>

        <!-- CTA SECTION -->
        <section class="cta-section">
            <h2 class="cta-title">Tertarik Memasang Advertorial?</h2>
            <p class="cta-text">
                Jadikan brand Anda lebih dikenal dengan advertorial yang menarik dan informatif.
                Tim kami siap membantu membuat konten yang sesuai dengan kebutuhan bisnis Anda.
            </p>
            <div class="cta-buttons">
                <a href="#" class="cta-btn primary">Konsultasi Gratis</a>
                <a href="#" class="cta-btn secondary">Lihat Paket</a>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        /* SALIN SEMUA KODE <style> DARI FILE advertorial LAMA ANDA KE SINI */
    </style>
@endpush
