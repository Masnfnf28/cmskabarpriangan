@extends('layouts.frontend')

@section('content')
<main class="container">
    <!-- ABOUT SECTION -->
    <section class="about-section">
        <div class="about-image" data-aos="fade-right" data-aos-duration="1000">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Tentang Kami">
        </div>
        <div class="about-content" data-aos="fade-left" data-aos-duration="1000">
            <h2>Siapa Kami</h2>
            <p>Priangan TV merupakan media TV stream dari jejaring Kabar Priangan Network. Priangan TV memberikan informasi dan edukasi di wilayah Priangan Timur, seperti Tasikmalaya, Ciamis, Garut, Banjar, Pangandaran, dan Sumedang.
            </p>
            <p>Sebagai platform kontemporer dan inovatif, Priangan TV hadir sebagai media TV arus utama yang segar. Kami berkomitmen untuk menghadirkan konten yang menarik dan relevan, menghubungkan pemirsa kami melalui pengalaman menonton modern yang disesuaikan dengan lanskap digital masa kini.</p>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="mission-vision">
        <div class="mission" data-aos="fade-up" data-aos-delay="100">
            <h3>Misi Kami</h3>
            <p>Menyajikan informasi yang akurat, aktual, dan berimbang kepada masyarakat dengan mengedepankan prinsip-prinsip jurnalisme yang bertanggung jawab.</p>
            <p>Membangun kesadaran kritis masyarakat melalui konten yang mendidik, menginspirasi, dan memberdayakan.</p>
            <p>Menjadi platform yang inklusif dan dapat diakses oleh semua kalangan dengan menyajikan berita dalam format yang mudah dipahami.</p>
        </div>
        <div class="vision" data-aos="fade-up" data-aos-delay="200">
            <h3>Visi Kami</h3>
            <p>Menjadi media digital terdepan di Indonesia yang dikenal karena kredibilitas, inovasi, dan dampak positifnya bagi masyarakat.</p>
            <p>Mendorong terciptanya masyarakat yang terinformasi dengan baik dan mampu mengambil keputusan berdasarkan fakta dan data yang akurat.</p>
            <p>Menginspirasi generasi muda untuk terlibat aktif dalam proses demokrasi dan pembangunan bangsa melalui informasi yang berkualitas.</p>
        </div>
    </section>

    <!-- VALUES -->
    <section class="values-section">
        <h2 class="section-title" data-aos="fade-up">Nilai-Nilai Kami</h2>
        <div class="values-grid">
            <div class="value-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="value-icon">
                    ✓
                </div>
                <h3 class="value-title">Integritas</h3>
                <p>Kami selalu mengutamakan kejujuran, transparansi, dan akuntabilitas dalam setiap pemberitaan yang kami sajikan.</p>
            </div>
            <div class="value-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="value-icon">
                    ✓
                </div>
                <h3 class="value-title">Akurasi</h3>
                <p>Setiap informasi yang kami berikan telah melalui proses verifikasi yang ketat untuk memastikan kebenarannya.</p>
            </div>
            <div class="value-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="value-icon">
                    ✓
                </div>
                <h3 class="value-title">Inklusivitas</h3>
                <p>Kami berkomitmen untuk menyajikan berita yang mencakup berbagai perspektif dan dapat diakses oleh semua kalangan.</p>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact-section" data-aos="fade-up">
        <h2 class="section-title">Hubungi Kami</h2>
        <div class="contact-grid">
            <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                <h3>Informasi Kontak</h3>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            📍
                        </div>
                        <div class="contact-text">
                            <h4>Alamat</h4>
                            <p>Jl.dr. Soekardjo Nomor 70 Kelurahan Tawangsari Kecamatan Tawang Kota Tasikmalaya Jawa Barat (HU. Kabar Priangan)</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            📞
                        </div>
                        <div class="contact-text">
                            <h4>Telepon</h4>
                            <p>(0265) 1234-5678</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            ✉
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>priangantv2024@gmail.com
                            </p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            ⏰
                        </div>
                        <div class="contact-text">
                            <h4>Jam Operasional</h4>
                            <p>Senin - Jumat: 09.00 - 16.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form" data-aos="fade-left" data-aos-delay="200">
                <h3>Kirim Pesan</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subjek</label>
                        <input type="text" id="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Figtree', sans-serif;
        background-color: #f8fafc;
        color: #334155;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #fca311 0%, #ffb74d 100%);
        color: rgb(0, 0, 0);
        padding: 60px 0;
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .breadcrumb a {
        color: rgba(0, 0, 0, 0.9);
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .breadcrumb span {
        color: rgba(0, 0, 0, 0.9);
    }

    /* About Section */
    .about-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .about-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    .about-image img {
        width: 100%;
        border-radius: 8px;
        height: auto;
        display: block;
    }

    .about-content h2 {
        font-size: 2rem;
        color: #004c75;
        margin-bottom: 20px;
        position: relative;
    }

    .about-content h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: #fca311;
    }

    .about-content p {
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    /* Mission & Vision */
    .mission-vision {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .mission,
    .vision {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-top: 4px solid #fca311;
    }

    .mission h3,
    .vision h3 {
        color: #004c75;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .section-title {
        text-align: center;
        font-size: 2rem;
        color: #004c75;
        margin-bottom: 40px;
        position: relative;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #fca311;
    }

    /* Values Section */
    .values-section {
        margin-bottom: 60px;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .value-card {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s;
        border-top: 4px solid #fca311;
    }

    .value-card:hover {
        transform: translateY(-5px);
    }

    .value-icon {
        width: 70px;
        height: 70px;
        background-color: #fff8e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #fca311;
        font-size: 1.8rem;
    }

    .value-title {
        font-size: 1.3rem;
        color: #004c75;
        margin-bottom: 15px;
    }

    /* Contact Section */
    .contact-section {
        background-color: white;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 60px;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info h3,
    .contact-form h3 {
        color: #004c75;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .contact-details {
        margin-bottom: 30px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background-color: #fff8e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fca311;
        flex-shrink: 0;
    }

    .contact-text h4 {
        margin-bottom: 5px;
        color: #334155;
    }

    .contact-text p {
        color: #64748b;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #cbd5e1;
        border-radius: 5px;
        font-family: inherit;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #fca311;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .btn {
        display: inline-block;
        background-color: #0077b6;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #e59400;
    }

    /* Responsive Design - SEMUA STYLING MOBILE DIPERTAHANKAN */
    @media (max-width: 1024px) {

        .about-section,
        .mission-vision,
        .contact-grid {
            gap: 30px;
        }
    }

    @media (max-width: 768px) {

        .about-section,
        .mission-vision,
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }

        .about-content h2,
        .section-title {
            font-size: 1.7rem;
        }

        .contact-section {
            padding: 30px 20px;
        }

        .values-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }

        .mission,
        .vision {
            padding: 25px 20px;
        }

        .value-card {
            padding: 25px 20px;
        }

        .about-image {
            margin-top: 0;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 40px 0;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .contact-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .contact-icon {
            width: 35px;
            height: 35px;
        }

        .breadcrumb {
            flex-wrap: wrap;
            gap: 5px;
        }

        @media (max-width: 1024px) {

            .about-section,
            .mission-vision,
            .contact-grid {
                gap: 30px;
            }
        }

        @media (max-width: 768px) {

            /* Logo di tengah pada mobile */
            header {
                flex-direction: column;
                padding: 10px 15px;
            }

            .logo-container {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .logo {
                height: 40px;
                /* Ukuran lebih kecil di mobile */
            }

            .nav-container {
                width: 100%;
                justify-content: flex-end;
            }

            .hamburger {
                display: flex;
            }

            .nav-menu {
                display: none;
            }

            .about-section,
            .mission-vision,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2rem;
            }

            .about-content h2,
            .section-title {
                font-size: 1.7rem;
            }

            .contact-section {
                padding: 30px 20px;
            }

            .dropdown-menu {
                width: 180px;
                right: 10px;
            }

            .team-grid,
            .values-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }

        /* Tambahan untuk mobile yang sangat kecil */
        @media (max-width: 360px) {
            .container {
                padding: 0 15px;
            }

            .about-content h2 {
                font-size: 1.5rem;
            }

            .mission h3,
            .vision h3 {
                font-size: 1.3rem;
            }

            .contact-section {
                padding: 20px 15px;
            }

            .value-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* Footer Mobile Optimization */
        @media (max-width: 768px) {
            footer {
                padding: 20px 0;
                margin-top: 30px;
                background-color: #fca311;
                width: 100%;
            }

            .footer-container {
                padding: 0 15px;
            }

            .social-icons {
                gap: 12px;
                margin: 0 0 15px 0;
            }

            .social-icon {
                width: 45px;
                height: 45px;
                background-color: #000000;
            }

            .social-icon svg {
                width: 20px;
                height: 20px;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 20px 0;
                margin-top: 30px;
            }

            .social-icons {
                gap: 10px;
                margin: 0 0 12px 0;
            }

            .social-icon {
                width: 40px;
                height: 40px;
            }

            .social-icon svg {
                width: 18px;
                height: 18px;
            }

            .footer-container p {
                font-size: 13px !important;
            }
        }

        @media (max-width: 360px) {
            footer {
                padding: 18px 0;
                margin-top: 25px;
            }

            .social-icons {
                gap: 8px;
                margin: 0 0 10px 0;
            }

            .social-icon {
                width: 38px;
                height: 38px;
            }

            .social-icon svg {
                width: 16px;
                height: 16px;
            }

            .footer-container {
                padding: 0 10px;
            }

            .footer-container p {
                font-size: 12px !important;
            }
        }
    }
</style>
@endpush