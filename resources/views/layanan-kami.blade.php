@extends('layouts.frontend')

@section('title', 'Layanan Kami')

@push('styles')
    <style>
        body {
            background-color: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Services Overview */
        .services-overview {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            color: #004c75;
            margin-bottom: 30px;
            position: relative;
            font-weight: 700;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #ffff5b;
        }

        .overview-text {
            max-width: 800px;
            margin: 0 auto 40px;
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.8;
        }

        /* Main Services */
        .main-services {
            margin-bottom: 60px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(252, 163, 17, 0.15);
            border-color: #ffff5b;
        }

        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffff5b, #ffb74d);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #023e8a, #0077b6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
        }

        .service-title {
            font-size: 1.4rem;
            color: #004c75;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .service-features {
            list-style: none;
            text-align: left;
            margin-bottom: 25px;
            padding: 0;
        }

        .service-features li {
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
        }

        .service-features li:before {
            content: '✓';
            color: #ffff5b;
            font-weight: bold;
        }

        .service-features li:last-child {
            border-bottom: none;
        }

        .service-btn {
            display: inline-block;
            background: linear-gradient(135deg, #023e8a, #0077b6);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .service-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(252, 163, 17, 0.3);
        }

        /* Pricing Section */
        .pricing-section {
            margin-bottom: 60px;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .pricing-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative;
            border: 2px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            border-color: #ffff5b;
            transform: translateY(-5px);
        }

        .pricing-card.popular {
            border-color: #ffff5b;
            transform: scale(1.05);
        }

        .pricing-card.popular:before {
            content: 'POPULER';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffff5b;
            color: white;
            padding: 5px 20px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pricing-header {
            margin-bottom: 30px;
        }

        .pricing-title {
            font-size: 1.3rem;
            color: #004c75;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .pricing-price {
            font-size: 2.5rem;
            color: #ffff5b;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .pricing-period {
            color: #64748b;
            font-size: 0.9rem;
        }

        .pricing-features {
            list-style: none;
            margin-bottom: 30px;
            padding: 0;
        }

        .pricing-features li {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            color: #64748b;
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        .pricing-features li.included:before {
            content: '✓ ';
            color: #ffff5b;
            font-weight: bold;
        }

        .pricing-features li.excluded:before {
            content: '✗ ';
            color: #ef4444;
        }

        /* Process Section */
        .process-section {
            margin-bottom: 60px;
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            counter-reset: step-counter;
        }

        .process-step {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative;
            counter-increment: step-counter;
        }

        .process-step:before {
            content: counter(step-counter);
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #0077b6, #0077b6);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .step-icon {
            width: 60px;
            height: 60px;
            background: #fff8e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #ffff5b;
            font-size: 1.5rem;
        }

        .step-title {
            font-size: 1.2rem;
            color: #004c75;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .process-step p {
            color: #64748b;
            line-height: 1.6;
        }

        /* Case Studies */
        .case-studies {
            margin-bottom: 60px;
        }

        .case-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .case-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .case-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .case-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .case-content {
            padding: 25px;
        }

        .case-title {
            font-size: 1.3rem;
            color: #004c75;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .case-client {
            color: #ffff5b;
            font-weight: 500;
            margin-bottom: 15px;
            display: block;
        }

        .case-content p {
            color: #64748b;
            line-height: 1.6;
        }

        .case-result {
            background: #fff8e1;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            border-left: 4px solid #ffff5b;
        }

        .case-result h4 {
            color: #004c75;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .case-result p {
            color: #64748b;
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #ffff5b, #ffb74d);
            color: white;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 60px;
        }

        .cta-title {
            font-size: 2.2rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            display: inline-block;
            padding: 15px 35px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #0077b6;
            color: #ffffff;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .services-grid,
            .pricing-grid,
            .process-steps,
            .case-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.7rem;
            }

            .pricing-card.popular {
                transform: none;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .cta-title {
                font-size: 1.8rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .service-card,
            .pricing-card,
            .process-step {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1.5rem;
            }

            .service-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }

            .pricing-price {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 1.6rem;
            }

            .cta-btn {
                padding: 12px 25px;
            }
        }

        @media (max-width: 360px) {
            .container {
                padding: 20px 15px;
            }

            .service-card,
            .pricing-card,
            .process-step {
                padding: 25px 15px;
            }
        }
    </style>
@endpush

@section('content')
    <main class="container">
        <!-- SERVICES OVERVIEW -->
        <section class="services-overview">
            <h2 class="section-title" data-aos="fade-up">Solusi Media Terpadu</h2>
            <p class="overview-text" data-aos="fade-up" data-aos-delay="100">
                Kami menyediakan berbagai layanan media yang komprehensif untuk membantu bisnis dan organisasi
                meningkatkan visibilitas, membangun reputasi, dan mencapai tujuan komunikasi mereka.
                Dengan tim profesional yang berpengalaman, kami siap mendukung kesuksesan Anda.
            </p>
        </section>

        <!-- MAIN SERVICES -->
        <section class="main-services">
            <h2 class="section-title" data-aos="fade-up">Layanan Unggulan Kami</h2>
            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon">🎬</div>
                    <h3 class="service-title">Penawaran Live Streaming</h3>
                    <ul class="service-features">
                        <li>Durasi : 5 Jam</li>
                        <li>Materi : Profil/Kegiatan/Program/Sosialisasi/DLL</li>
                        <li>Waktu : Sesuai Kesepakatan</li>
                        <li>Tempat : Sesuai Kesepakatan</li>
                        <li>Kanal Distribusi : Youtube Priangan TV</li>
                        <li>Harga : Rp 15.000.000</li>
                    </ul>
                    <button class="service-btn">Selengkapnya</button>
                </div>

                <!-- Service 2 -->
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon">🎥</div>
                    <h3 class="service-title">Penawaran Podcast</h3>
                    <ul class="service-features">
                        <li>Durasi : 30 Menit</li>
                        <li>Materi : Profil/Kegiatan/Program/Sosialisasi/DLL</li>
                        <li>Waktu : Senin-Jumat</li>
                        <li>Tempat : Studio Kabar Priangan atau Sesuai Kesepakatan</li>
                        <li>Kanal Distribusi : Youtube Priangan TV</li>
                        <li>Harga : Rp 5.000.000</li>
                    </ul>
                    <button class="service-btn">Selengkapnya</button>
                </div>

                <!-- Service 3 -->
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon">📊</div>
                    <h3 class="service-title">Penawaran Iklan</h3>
                    <ul class="service-features">
                        <li>Durasi : 15 Detik (diulang-ulang)</li>
                        <li>Materi : Sesuai Produk</li>
                        <li>Waktu : 7 Hari</li>
                        <li>Tempat : Monitor studio dan under video</li>
                        <li>Tampilan : Monitor graphic dan running text</li>
                        <li>Harga : Rp 500.000</li>
                    </ul>
                    <button class="service-btn">Selengkapnya</button>
                </div>
            </div>
        </section>

        <!-- PRICING SECTION -->


        <!-- PROCESS SECTION -->
        <section class="process-section">
            <h2 class="section-title" data-aos="fade-up">Proses Kerja Kami</h2>
            <div class="process-steps">
                <div class="process-step" data-aos="flip-left" data-aos-delay="100">
                    <div class="step-icon">🔍</div>
                    <h3 class="step-title">Konsultasi & Analisis</h3>
                    <p>Memahami kebutuhan dan tujuan klien melalui diskusi mendalam dan analisis kebutuhan.</p>
                </div>
                <div class="process-step" data-aos="flip-left" data-aos-delay="200">
                    <div class="step-icon">📋</div>
                    <h3 class="step-title">Perencanaan Strategi</h3>
                    <p>Menyusun rencana dan strategi yang disesuaikan dengan tujuan dan anggaran klien.</p>
                </div>
                <div class="process-step" data-aos="flip-left" data-aos-delay="300">
                    <div class="step-icon">🎬</div>
                    <h3 class="step-title">Eksekusi & Produksi</h3>
                    <p>Melaksanakan rencana dengan tim profesional dan teknologi terbaik.</p>
                </div>
                <div class="process-step" data-aos="flip-left" data-aos-delay="400">
                    <div class="step-icon">📊</div>
                    <h3 class="step-title">Monitoring & Evaluasi</h3>
                    <p>Memantau hasil dan melakukan evaluasi untuk optimasi berkelanjutan.</p>
                </div>
            </div>
        </section>

        <!-- CASE STUDIES -->
        <section class="case-studies">
            <h2 class="section-title" data-aos="fade-up">Studi Kasus</h2>
            <div class="case-grid">
                <div class="case-card" data-aos="fade-right" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Case Study 1" class="case-image">
                    <div class="case-content">
                        <h3 class="case-title">Kampanye Brand Awareness</h3>
                        <span class="case-client">PT. Sukses Makmur</span>
                        <p>Meningkatkan brand awareness sebesar 150% dalam 3 bulan melalui strategi content marketing
                            terintegrasi.</p>
                        <div class="case-result">
                            <h4>Hasil yang Dicapai:</h4>
                            <p>+150% brand awareness, +80% engagement rate, +45% website traffic</p>
                        </div>
                    </div>
                </div>
                <div class="case-card" data-aos="fade-left" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Case Study 2" class="case-image">
                    <div class="case-content">
                        <h3 class="case-title">Krisis Management</h3>
                        <span class="case-client">Global Tech Company</span>
                        <p>Menangani krisis komunikasi dan memulihkan reputasi perusahaan dalam waktu 2 minggu.</p>
                        <div class="case-result">
                            <h4>Hasil yang Dicapai:</h4>
                            <p>90% sentiment positif, reputasi pulih 100%, zero media coverage negatif</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA SECTION -->
        <section class="cta-section" data-aos="zoom-in">
            <h2 class="cta-title">Siap Meningkatkan Bisnis Anda?</h2>
            <p class="cta-text">
                Mari berdiskusi tentang bagaimana layanan kami dapat membantu mencapai tujuan komunikasi dan bisnis
                Anda.
                Tim konsultan kami siap memberikan solusi terbaik.
            </p>
            <div class="cta-buttons">
                <a href="#" class="cta-btn">Konsultasi Gratis</a>
                <a href="#" class="cta-btn">Hubungi Kami</a>
            </div>
        </section>
    </main>
@endsection
