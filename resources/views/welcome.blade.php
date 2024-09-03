<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Arsha Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link rel="icon" href="{{ asset('img/logo-aja.png') }}" />

    <!-- Fonts -->
    <link href="{{ asset('https://fonts.googleapis.com') }}" rel="preconnect">
    <link href="{{ asset('https://fonts.gstatic.com') }}" rel="preconnect" crossorigin>
    <link
        href="{{ asset('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap') }}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #FFFFFF;">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/img/logo_sekolah.png" alt="" <h1 class="sitename">SMP NEGERI 5 TARANO</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Profil</a></li>
                    <li><a href="#dokumentasi">Dokumentasi</a></li>
                    <li><a href="#team">Guru</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background"
            style="background-image: url('assets/img/image_sekolah.png')">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h1>SMP NEGERI 5 TARANO</h1>
                        <p>Jln.desa bantu lanteh, Bantulanteh, Kec. Tarano, Kabupaten Sumbawa, Nusa Tenggara Barat 84384
                        </p>
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class="btn-get-started"
                                style="background-color: #FFFFFF; color: #37CC1A">Login</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>PROFIL</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <h2 style="text-align: center">Visi</h2>
                        <p>
                            Menjadi sekolah yang unggul dalam prestasi akademik dan non-akademik, serta berperan aktif
                            dalam membentuk generasi muda yang berkarakter, berakhlak mulia, dan memiliki keterampilan
                            hidup yang relevan untuk menghadapi tantangan di masa depan.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> <span>Meningkatkan Kualitas Pembelajaran.</span>
                            </li>
                            <li><i class="bi bi-check2-circle"></i> <span>Pengembangan Karakter.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Peningkatan Sarana dan Prasarana.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Pengembangan Potensi Siswa.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Penguatan Hubungan dengan Masyarakat.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 style="text-align: center">Misi</h2>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> <span>Mengembangkan metode pembelajaran yang kreatif
                                    dan inovatif untuk meningkatkan pemahaman siswa.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Memanfaatkan teknologi informasi meskipun
                                    dalam keterbatasan fasilitas, untuk memperkaya proses belajar-mengajar.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Menanamkan nilai-nilai moral dan etika melalui
                                    kegiatan keagamaan, sosial, dan budaya.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Mendorong sikap disiplin, tanggung jawab, dan
                                    kemandirian pada setiap siswa.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Mengupayakan peningkatan fasilitas sekolah
                                    secara bertahap melalui kerjasama dengan pemerintah, orang tua, dan masyarakat
                                    sekitar.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Memberikan kesempatan kepada siswa untuk
                                    berpartisipasi dalam berbagai lomba dan kegiatan di tingkat lokal maupun
                                    regional.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Mengembangkan kegiatan berbasis komunitas yang
                                    dapat memberikan manfaat langsung bagi masyarakat sekitar.</span></li>
                        </ul>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Portfolio Section -->
        <section id="dokumentasi" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>DOKUMENTASI</h2>
                <p>Arsip digital yang menampilkan dokumentasi sekolah dan kegiatan siswa di SMP Negeri 5 Tarano. Di
                    sini, Anda dapat menemukan dokumentasi foto, dari sekolah dan kegiatan kegiatan siswa yang telah
                    dilaksanakan di sekolah.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".kegiatan">Kegiatan</li>
                        <li data-filter=".sekolah">Sekolah</li>
                        <li data-filter=".lomba">Lomba</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($media as $item)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $item->type }}">
                                <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid" alt="{{ $item->type }}">
                                <div class="portfolio-info">
                                    <h4>{{ $item->type }}</h4>
                                    <p>{{ $item->deskripsi }}</p>
                                    <a href="{{ asset($item->image) }}" title="{{ $item->type }}"
                                        data-gallery="portfolio-gallery-{{ $item->type }}"
                                        class="glightbox preview-link">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link">
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </section><!-- /Portfolio Section -->

        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Guru</h2>
                <p>Data Staff guru pengajar SMP Negeri 5 Tarano</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    @foreach ($guru as $key => $value)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member d-flex align-items-start">
                                @if ($value->image)
                                    <div class="pic"><img src="{{ asset('storage/' . $value->image) }}"
                                            class="img-fluid" alt=""></div>
                                @else
                                    <div class="pic"><img src="{{ asset('img/undraw_profile_2.svg') }}"
                                            class="img-fluid" alt=""></div>
                                @endif
                                <div class="member-info">
                                    <h4>{{ $value->username }}</h4>
                                    <span>{{ $value->jabatan }}</span>
                                    <p>Sosial Media :</p>
                                    <div class="social">
                                        <a href=""><i class="bi bi-twitter-x"></i></a>
                                        <a href=""><i class="bi bi-facebook"></i></a>
                                        <a href=""><i class="bi bi-instagram"></i></a>
                                        <a href=""> <i class="bi bi-linkedin"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </section><!-- /Team Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">

                <div class="col-lg-6 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SMPN 5 Tarano</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jln.desa bantu lanteh, Bantulanteh, Kec. Tarano,</p>
                        <p>Kabupaten Sumbawa, Nusa Tenggara Barat 84384</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>-</span></p>
                        <p><strong>Email:</strong> <span>-</span></p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <h4>Follow Us</h4>
                    <p>Untuk Mengetahui informasi lebih lanjut silakan ikuti sosial media kami</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Arsha</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <b>BootstrapMade</b>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
