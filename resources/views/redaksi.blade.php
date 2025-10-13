@extends('layouts.frontend')

@section('content')
    <main class="container">
        <!-- REDAKSI INFO -->
        <section class="redaksi-info">
            <h2>Profil Redaksi Media Portal</h2>
            <p>Redaksi Media Portal terdiri dari tim jurnalis profesional yang berkomitmen untuk menyajikan berita yang akurat, berimbang, dan bertanggung jawab. Kami mengutamakan prinsip-prinsip jurnalisme yang independen dan selalu berpedoman pada kode etik jurnalistik.</p>
            
            <div class="info-grid">
                <div class="info-card">
                    <h3>Visi Redaksi</h3>
                    <p>Menjadi sumber informasi terpercaya yang mengedukasi masyarakat dan berkontribusi positif bagi perkembangan demokrasi di Indonesia.</p>
                </div>
                <div class="info-card">
                    <h3>Misi Redaksi</h3>
                    <p>Menyajikan berita yang faktual, aktual, dan relevan dengan mengedepankan prinsip keadilan, akurasi, dan keberimbangan.</p>
                </div>
                <div class="info-card">
                    <h3>Nilai-Nilai</h3>
                    <p>Integritas, Independensi, Akurasi, Keberimbangan, dan Tanggung Jawab Sosial.</p>
                </div>
            </div>
        </section>

        <!-- STRUKTUR REDAKSI -->
        <section class="structure-section">
            <h2 class="section-title">Struktur Redaksi</h2>
            <div class="structure-grid">
                <div class="department">
                    <h3>Pimpinan Redaksi</h3>
                    <ul class="team-list">
                        <li>
                            <span class="member-name">Dr. Sari Dewi, M.Si</span>
                            <span class="member-role">Pemimpin Redaksi</span>
                        </li>
                        <li>
                            <span class="member-name">Budi Santoso, S.Sos</span>
                            <span class="member-role">Wakil Pemimpin Redaksi</span>
                        </li>
                    </ul>
                </div>
                
                <div class="department">
                    <h3>Editorial</h3>
                    <ul class="team-list">
                        <li>
                            <span class="member-name">Maya Sari, S.I.Kom</span>
                            <span class="member-role">Editor in Chief</span>
                        </li>
                        <li>
                            <span class="member-name">Rizki Pratama, S.Hum</span>
                            <span class="member-role">Senior Editor</span>
                        </li>
                        <li>
                            <span class="member-name">Dina Anggraeni, S.Sos</span>
                            <span class="member-role">Copy Editor</span>
                        </li>
                    </ul>
                </div>
                
                <div class="department">
                    <h3>Reporter & Jurnalis</h3>
                    <ul class="team-list">
                        <li>
                            <span class="member-name">Ahmad Fauzi</span>
                            <span class="member-role">Senior Reporter</span>
                        </li>
                        <li>
                            <span class="member-name">Linda Suryani</span>
                            <span class="member-role">Political Correspondent</span>
                        </li>
                        <li>
                            <span class="member-name">Rudi Hermawan</span>
                            <span class="member-role">Economic Reporter</span>
                        </li>
                        <li>
                            <span class="member-name">Siti Rahayu</span>
                            <span class="member-role">Social Affairs Reporter</span>
                        </li>
                    </ul>
                </div>
                
                <div class="department">
                    <h3>Divisi Khusus</h3>
                    <ul class="team-list">
                        <li>
                            <span class="member-name">Dewi Kartika</span>
                            <span class="member-role">Investigative Journalist</span>
                        </li>
                        <li>
                            <span class="member-name">Fajar Nugroho</span>
                            <span class="member-role">Data Journalist</span>
                        </li>
                        <li>
                            <span class="member-name">Nina Permata</span>
                            <span class="member-role">Fact Checker</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- TIM EDITORIAL -->
        <section class="editorial-team">
            <h2 class="section-title">Tim Editorial</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Wakil Pemimpin Redaksi" class="member-photo">
                    <div class="member-info">
                        <h3 class="member-name">Dr. Sari Dewi, M.Si</h3>
                        <span class="member-position">Pemimpin Redaksi</span>
                        <p class="member-bio">Memimpin redaksi sejak 2018 dengan pengalaman 15 tahun di dunia jurnalistik. Spesialisasi dalam analisis politik dan isu sosial.</p>
                        <div class="member-contact">
                            <a href="mailto:sari.dewi@mediaportal.com" class="contact-btn">✉</a>
                            <a href="#" class="contact-btn">📱</a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Wakil Pemimpin Redaksi" class="member-photo">
                    <div class="member-info">
                        <h3 class="member-name">Budi Santoso, S.Sos</h3>
                        <span class="member-position">Wakil Pemimpin Redaksi</span>
                        <p class="member-bio">Bergabung sejak 2015, ahli dalam manajemen redaksi dan pengembangan konten digital. Fokus pada inovasi platform berita.</p>
                        <div class="member-contact">
                            <a href="mailto:budi.santoso@mediaportal.com" class="contact-btn">✉</a>
                            <a href="#" class="contact-btn">📱</a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Editor in Chief" class="member-photo">
                    <div class="member-info">
                        <h3 class="member-name">Maya Sari, S.I.Kom</h3>
                        <span class="member-position">Editor in Chief</span>
                        <p class="member-bio">Memastikan kualitas setiap konten yang diterbitkan. Spesialis dalam editing dan verifikasi fakta dengan pengalaman 10 tahun.</p>
                        <div class="member-contact">
                            <a href="mailto:maya.sari@mediaportal.com" class="contact-btn">✉</a>
                            <a href="#" class="contact-btn">📱</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KODE ETIK -->
        <section class="ethics-section">
            <h2 class="section-title">Kode Etik Jurnalistik</h2>
            <p>Redaksi Media Portal berkomitmen untuk selalu menjunjung tinggi kode etik jurnalistik dalam setiap pemberitaan. Berikut adalah prinsip-prinsip yang kami pegang teguh:</p>
            
            <div class="ethics-grid">
                <div class="ethics-card">
                    <h3>Independensi</h3>
                    <p>Redaksi bekerja secara independen tanpa campur tangan dari pihak manapun. Berita disajikan secara objektif tanpa dipengaruhi kepentingan tertentu.</p>
                </div>
                
                <div class="ethics-card">
                    <h3>Akurasi</h3>
                    <p>Setiap informasi yang disampaikan telah melalui proses verifikasi yang ketat. Kami bertanggung jawab atas keakuratan data dan fakta yang disajikan.</p>
                </div>
                
                <div class="ethics-card">
                    <h3>Keberimbangan</h3>
                    <p>Memberikan ruang yang sama kepada semua pihak yang terkait dalam sebuah pemberitaan. Menghindari pemberitaan sepihak yang tidak berimbang.</p>
                </div>
                
                <div class="ethics-card">
                    <h3>Prinsip Praduga Tak Bersalah</h3>
                    <p>Menghormati hak setiap individu untuk dianggap tidak bersalah sampai pengadilan menyatakan bersalah. Tidak melakukan trial by media.</p>
                </div>
            </div>
        </section>

        <!-- KONTAK REDAKSI -->
        <section class="contact-section">
            <h2 class="section-title">Hubungi Redaksi</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Informasi Kontak Redaksi</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                📍
                            </div>
                            <div class="contact-text">
                                <h4>Alamat Redaksi</h4>
                                <p>Gedung Media Portal Lt. 3<br>Jl. Jenderal Sudirman No. 123<br>Jakarta Pusat 10220</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                📞
                            </div>
                            <div class="contact-text">
                                <h4>Telepon</h4>
                                <p>(021) 1234-5678 (Hunting)<br>(021) 1234-5679 (Redaksi)</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                ✉
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p>redaksi@mediaportal.com<br>editor@mediaportal.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                ⏰
                            </div>
                            <div class="contact-text">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jumat: 08.00 - 17.00 WIB<br>Sabtu: 08.00 - 14.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Kirim Pesan ke Redaksi</h3>
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
                            <select id="subject" class="form-control" required>
                                <option value="">Pilih Subjek</option>
                                <option value="koreksi">Koreksi Berita</option>
                                <option value="saran">Saran & Masukan</option>
                                <option value="info">Informasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" class="form-control" placeholder="Tulis pesan Anda untuk redaksi..." required></textarea>
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
        
        /* Redaksi Info */
        .redaksi-info {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }
        
        .redaksi-info h2 {
            color: #004c75;
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #fca311;
            padding-bottom: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .info-card {
            background: #f8fafc;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid #fca311;
        }
        
        .info-card h3 {
            color: #004c75;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        /* Team Structure */
        .structure-section {
            margin-bottom: 50px;
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
        
        .structure-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .department {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #fca311;
        }
        
        .department h3 {
            color: #004c75;
            font-size: 1.4rem;
            margin-bottom: 20px;
        }
        
        .team-list {
            list-style: none;
        }
        
        .team-list li {
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .team-list li:last-child {
            border-bottom: none;
        }
        
        .member-name {
            font-weight: 500;
        }
        
        .member-role {
            color: #fca311;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* Editorial Team */
        .editorial-team {
            margin-bottom: 50px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .team-member {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .member-photo {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .member-info {
            padding: 20px;
        }
        
        .member-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #004c75;
            margin-bottom: 5px;
        }
        
        .member-position {
            color: #fca311;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }
        
        .member-bio {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 15px;
        }
        
        .member-contact {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .contact-btn {
            width: 35px;
            height: 35px;
            background: #fff8e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fca311;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .contact-btn:hover {
            background: #fca311;
            color: white;
        }
        
        /* Code of Ethics */
        .ethics-section {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }
        
        .ethics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .ethics-card {
            background: #f8fafc;
            padding: 25px;
            border-radius: 8px;
            border-top: 4px solid #fca311;
        }
        
        .ethics-card h3 {
            color: #004c75;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }
        
        /* Contact Redaksi */
        .contact-section {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        
        .contact-info h3 {
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
            background: #fff8e1;
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
            background: #0077b6;
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
            background: #e59400;
        }
        
        /* Responsive Design - SEMUA STYLING MOBILE DIPERTAHANKAN */
        @media (max-width: 1024px) {
            .contact-grid,
            .ethics-grid,
            .structure-grid,
            .info-grid {
                gap: 25px;
            }
        }
        
        @media (max-width: 768px) {
            .contact-grid,
            .ethics-grid,
            .structure-grid,
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.7rem;
            }
            
            .redaksi-info,
            .ethics-section,
            .contact-section {
                padding: 25px 20px;
            }
            
            .team-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            /* Mobile specific styles untuk konten */
            .department h3 {
                font-size: 1.3rem;
            }
            
            .team-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .member-role {
                font-size: 0.85rem;
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
            
            .department,
            .ethics-card,
            .info-card {
                padding: 20px;
            }
            
            .team-grid {
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
            
            .member-contact {
                justify-content: center;
            }
            
            .breadcrumb {
                flex-wrap: wrap;
                gap: 5px;
            }
            @media (max-width: 1024px) {
            .about-section, .mission-vision, .contact-grid {
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
                height: 40px; /* Ukuran lebih kecil di mobile */
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
            
            .about-section, .mission-vision, .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .about-content h2, .section-title {
                font-size: 1.7rem;
            }
            
            .contact-section {
                padding: 30px 20px;
            }
            
            .dropdown-menu {
                width: 180px;
                right: 10px;
            }
            
            .team-grid, .values-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }

        /* Tambahan untuk mobile yang sangat kecil */
        @media (max-width: 360px) {
            .container {
                padding: 0 15px;
            }
            
            .page-title {
                font-size: 1.6rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .redaksi-info h2 {
                font-size: 1.5rem;
            }
            
            .info-card h3,
            .ethics-card h3 {
                font-size: 1.1rem;
            }
            
            .contact-grid {
                gap: 25px;
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
    </style>
@endpush