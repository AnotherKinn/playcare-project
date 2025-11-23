<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>PlayCare — Landing</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animate On Scroll -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <style>
        /* rona turquoise mirip referensi */
        /* Hapus width: 100% !important; dari #map */
        body {
            overflow-x: hidden;
        }

        #map {
            height: 380px;
            /* Sesuaikan dengan tinggi di HTML */
            /* Jangan pakai width: 100% !important; */
        }

        .leaflet-container {
            height: 100%;
            width: 100%;
        }

        :root {
            --pc-turquoise: #2bbec6;
            --pc-dark: #0f1724;
        }

        /* background tekstur untuk hero (subtle) */
        .hero-texture {
            background-image: url('https://i.pinimg.com/1200x/47/ca/ff/47caff75bd878b26e6283bcf1f96d8f0.jpg');
            background-size: cover;
            opacity: 0.8;
        }

        /* soft card shadow like reference */
        .soft-card {
            box-shadow: 0 10px 30px rgba(43, 68, 84, 0.06);
        }

        /* badge active for toggle */
        .toggle-active {
            background: linear-gradient(180deg, rgba(43, 68, 84, 0.03), rgba(43, 68, 84, 0.01));
            box-shadow: 0 8px 20px rgba(43, 68, 84, 0.04);
        }

        /* simple container width limit */
        .max-w-site {
            max-width: 1140px;
        }

        /* Hilangkan scrollbar untuk tampilan bersih */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-slate-800">

    <!-- NAVBAR (sticky) -->
    <header class="sticky top-0 z-50 bg-[color:var(--pc-turquoise)]" data-aos="fade-down" data-aos-easing="ease-in-out"
        data-aos-duration="600">
        <div class="max-w-site mx-auto px-6 lg:px-8">
            <nav class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="#" class="flex items-center gap-3 text-white">
                    <!-- simple SVG logo placeholder -->
                    <img src="{{ asset('assets/images/logo-playcare.png') }}" width="60" height="60" alt="">
                    <span class="font-semibold text-xl">PlayCare</span>
                </a>

                <!-- Menu (desktop) -->
                <div class="hidden md:flex items-center gap-6 text-white">
                    <a class="hover:underline" href="#mitra">Mitra Kami</a>
                    <a class="hover:underline" href="#tentang">Tentang Kami</a>
                    <a class="hover:underline" href="#faq">FAQ</a>
                    <a class="hover:underline" href="#testimoni">Testimoni</a>

                    <a href="{{ route('login') }}"
                        class="ml-2 inline-block rounded-full border border-white py-1 px-4 hover:bg-white/10 transition">Gabung
                        Kami</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="btn-mobile" class="text-white" aria-label="menu">
                        <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile menu content -->
        <div id="mobile-menu" class="hidden md:hidden bg-[color:var(--pc-turquoise)]/95">
            <div class="px-6 pb-6 space-y-2">
                <a class="block text-white py-2" href="#mitra">Mitra Kami</a>
                <a class="block text-white py-2" href="#tentang">Tentang Kami</a>
                <a class="block text-white py-2" href="#faq">FAQ</a>
                <a class="block text-white py-2" href="#testimoni">Testimoni</a>
                <a class="block text-white py-2 border border-white rounded-full inline-block text-center"
                    href="{{ route('login') }}">Gabung Kami</a>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero-texture bg-cover bg-center" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8 py-24 md:py-28">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-8">
                <!-- Left: Headline -->
                <div class="w-full lg:w-1/2 text-center lg:text-left" data-aos="fade-right"
                    data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="100">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white drop-shadow-lg">Aplikasi Super
                        Parenting.<br class="hidden lg:block" />Solusi Pengasuhan Anak yang Terintegrasi</h1>
                    <p class="mt-4 text-white/90 max-w-xl">Pantau aktivitas, transaksi, dan laporan anak secara digital.
                        Terhubung langsung dengan mitra daycare dan layanan pengasuhan terpercaya.</p>
                    <div class="mt-6 flex justify-center lg:justify-start gap-4">
                        <a href="{{ route('login') }}"
                            class="inline-block bg-white text-[color:var(--pc-turquoise)] font-semibold py-2 px-5 rounded-full shadow">Gabung
                            Sekarang</a>
                        <a href="#tentang"
                            class="inline-block border border-white text-white py-2 px-5 rounded-full">Pelajari Lebih
                            Lanjut</a>
                    </div>
                </div>

                <!-- Right: Mockup phone -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end" data-aos="fade-left"
                    data-aos-easing="ease-in-out" data-aos-duration="700" data-aos-delay="200">
                    <div class="relative">
                        <!-- phone mockup placeholder -->

                        <!-- watermark circle partial -->
                        <div class="absolute -bottom-6 -right-6 w-16 h-16 rounded-full bg-white/60"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTICS -->
    <section class="py-12" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-6 md:p-8 soft-card">
                <div class="flex flex-col md:flex-row items-center justify-between text-center gap-4">
                    <div class="flex-1" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-delay="100">
                        <div class="text-2xl md:text-3xl font-bold text-[color:var(--pc-turquoise)]">597++</div>
                        <div class="text-sm text-slate-500">Orang Tua Bergabung</div>
                    </div>
                    <div class="hidden md:block border-l h-12 border-slate-200 mx-6"></div>

                    <div class="flex-1" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-delay="200">
                        <div class="text-2xl md:text-3xl font-bold text-[color:var(--pc-turquoise)]">45++</div>
                        <div class="text-sm text-slate-500">Mitra Daycare</div>
                    </div>
                    <div class="hidden md:block border-l h-12 border-slate-200 mx-6"></div>

                    <div class="flex-1" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-delay="300">
                        <div class="text-2xl md:text-3xl font-bold text-[color:var(--pc-turquoise)]">400++</div>
                        <div class="text-sm text-slate-500">Total Anak Terdaftar</div>
                    </div>
                    <div class="hidden md:block border-l h-12 border-slate-200 mx-6"></div>

                    <div class="flex-1" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-delay="400">
                        <div class="text-2xl md:text-3xl font-bold text-[color:var(--pc-turquoise)]">27++</div>
                        <div class="text-sm text-slate-500">Artikel Parenting</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE / FEATURES -->
    <!-- WHY CHOOSE / FEATURES -->
    <section id="features" class="py-16 bg-white" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8">

            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-[color:var(--pc-turquoise)] font-semibold tracking-wider">
                    MENGAPA MEMILIH PLAYCARE
                </h3>
            </div>

            <!-- grid fitur -->
            <div id="features-grid" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up"
                data-aos-delay="200">

                <!-- card 1 – Pencarian Fleksibel -->
                <article class="bg-white rounded-xl p-6 flex items-center gap-6 soft-card" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex-1">
                        <h4 class="text-lg font-bold">Pencarian Fleksibel</h4>
                        <p class="mt-2 text-sm text-slate-500">
                            Memudahkan orang tua melakukan pencarian fasilitas pengasuhan anak.
                        </p>
                    </div>

                    <div class="w-20 h-20 bg-[color:var(--pc-turquoise)] rounded-xl flex items-center justify-center">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-search-check-icon lucide-search-check">
                            <path d="m8 11 2 2 4-4" />
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />

                        </svg>
                    </div>
                </article>

                <!-- card 2 – Transaksi Mudah -->
                <article class="bg-white rounded-xl p-6 flex items-center gap-6 soft-card" data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="flex-1">
                        <h4 class="text-lg font-bold">Transaksi Mudah</h4>
                        <p class="mt-2 text-sm text-slate-500">
                            Transaksi pembayaran yang mudah dari mana saja dan kapan saja.
                        </p>
                    </div>

                    <div class="w-20 h-20 bg-[color:var(--pc-turquoise)] rounded-xl flex items-center justify-center">
                        <!-- Credit Card Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-hand-coins-icon lucide-hand-coins">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                            <path
                                d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                            <path d="m2 16 6 6" />
                            <circle cx="16" cy="9" r="2.9" />
                            <circle cx="6" cy="5" r="3" /></svg>
                    </div>
                </article>

                <!-- card 3 – Monitoring Terintegrasi -->
                <article class="bg-white rounded-xl p-6 flex items-center gap-6 soft-card" data-aos="fade-up"
                    data-aos-delay="500">
                    <div class="flex-1">
                        <h4 class="text-lg font-bold">Monitoring Terintegrasi</h4>
                        <p class="mt-2 text-sm text-slate-500">
                            Pemantauan aktivitas anak secara langsung dari ponsel orang tua.
                        </p>
                    </div>

                    <div class="w-20 h-20 bg-[color:var(--pc-turquoise)] rounded-xl flex items-center justify-center">
                        <!-- Eye Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-scan-heart-icon lucide-scan-heart">
                            <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                            <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                            <path
                                d="M7.828 13.07A3 3 0 0 1 12 8.764a3 3 0 0 1 4.172 4.306l-3.447 3.62a1 1 0 0 1-1.449 0z" />
                        </svg>
                    </div>
                </article>

                <!-- card 4 – Pelaporan Digital -->
                <article class="bg-white rounded-xl p-6 flex items-center gap-6 soft-card" data-aos="fade-up"
                    data-aos-delay="600">
                    <div class="flex-1">
                        <h4 class="text-lg font-bold">Pelaporan Digital</h4>
                        <p class="mt-2 text-sm text-slate-500">
                            Digitalisasi pelaporan aktivitas anak sehingga orang tua selalu update.
                        </p>
                    </div>

                    <div class="w-20 h-20 bg-[color:var(--pc-turquoise)] rounded-xl flex items-center justify-center">
                        <!-- Document Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book-open-text-icon lucide-book-open-text">
                            <path d="M12 7v14" />
                            <path d="M16 12h2" />
                            <path d="M16 8h2" />
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                            <path d="M6 12h2" />
                            <path d="M6 8h2" /></svg>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="tentang" class="py-16 bg-white" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-delay="100">
                    <h3 class="text-[color:var(--pc-turquoise)] font-semibold tracking-wider">TENTANG APLIKASI PLAYCARE
                    </h3>
                    <h2 class="mt-4 text-2xl font-bold">Apa itu PLAYCARE?</h2>
                    <p class="mt-3 text-slate-600 leading-relaxed">PlayCare adalah platform digital (aplikasi) yang
                        memudahkan orang tua dalam mengasuh anak secara terintegrasi bersama mitra-mitra pengasuhan
                        seperti daycare, playground, dan kelas aktivitas. Semua informasi, transaksi, dan laporan dapat
                        diakses di satu genggaman kapan saja dan dimana saja.</p>
                </div>
                <div data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-delay="200">
                    <div class="rounded-xl overflow-hidden soft-card">
                        <img src="https://i.pinimg.com/1200x/cf/9a/da/cf9adae02b685eb77e55506a64c8532f.jpg"
                            alt="Tentang PlayCare" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR UTAMA KAMI -->
    <section id="fitur-utama" class="py-16 bg-white" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up" data-aos-delay="100">
                <span class="text-[color:var(--pc-turquoise)] text-sm tracking-wide font-semibold">FITUR BOONDA</span>
                <h3 class="mt-2 text-3xl font-extrabold text-slate-800">Fitur Utama Kami</h3>
            </div>

            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
                <!-- Left list -->
                <div class="flex-1 space-y-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon smile placeholder-->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Integrasi Pencarian, Pemesanan &amp; Pembayaran
                                Mitra Pengasuhan Anak</h4>
                            <p class="text-sm text-slate-600">Kemudahan pemesanan dan pembayaran mitra pengasuhan anak
                                dalam satu genggaman</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon crown placeholder -->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Pemantauan Aktivitas Anak Secara Langsung</h4>
                            <p class="text-sm text-slate-600">Live monitoring untuk mengetahui aktivitas anak saat
                                dititipkan ke Tempat Penitipan Anak (Daycare)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon clock placeholder -->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Rekomendasi Event Bonding Anak dan Orang Tua</h4>
                            <p class="text-sm text-slate-600">Kemudahan Pencarian dan Pemesanan Tiket Event Bonding Anak
                                dan Orang Tua sesuai Lokasi Terdekat</p>
                        </div>
                    </div>
                </div>

                <!-- Center image phone mockup -->
                <div class="flex-shrink-0 max-w-xs mx-auto lg:mx-0 lg:max-w-[240px] shadow-soft-card rounded-3xl overflow-hidden"
                    data-aos="zoom-in" data-aos-delay="300">
                    <img src="https://www.boonda.id/img/fitur/Fitur%20Pencarian.png" alt="Fitur Utama PlayCare"
                        class="w-[180px] h-[380px] object-contain">
                </div>

                <!-- Right list -->
                <div class="flex-1 space-y-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon report placeholder -->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9 12h6"></path>
                                <path d="M12 9v6"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Pelaporan Aktivitas Anak</h4>
                            <p class="text-sm text-slate-600">Digitalisasi pelaporan aktivitas anak yang sedang
                                dititipkan di dalam daycare</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon monitor placeholder -->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 3h-8a2 2 0 0 0-2 2v2h12V5a2 2 0 0 0-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Monitoring Tumbuh Kembang Anak</h4>
                            <p class="text-sm text-slate-600">Pemantauan Tumbuh Kembang Anak yang terintegrasi dalam
                                satu genggaman</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 bg-[#bef3f7] rounded-full p-3">
                            <!-- icon transaction placeholder -->
                            <svg class="w-6 h-6 text-[color:var(--pc-turquoise)]" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M4 7h16"></path>
                                <path d="M4 12h16"></path>
                                <path d="M10 17h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800">Rekap Transaksi Pemesanan &amp; Pembayaran</h4>
                            <p class="text-sm text-slate-600">Kemudahan rekap transaksi pemesanan &amp; pembayaran dari
                                orang tua saat melakukan transaksi dengan mitra pengasuhan anak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp -->
{{--    <a href="https://wa.me/6289601184436" target="_blank"
        class="fixed right-6 bottom-6 bg-[color:var(--pc-turquoise)] w-14 h-14 rounded-full flex items-center justify-center drop-shadow-lg"
        data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-delay="100">
        <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none">
            <path d="M21 12.1a9 9 0 1 0-2.6 6.1L21 21l-2.8-0.7A9 9 0 0 0 21 12.1z" fill="white" /></svg>
    </a> --}}

    <!-- FAQ -->
    <section id="faq" class="py-16 bg-white" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-[color:var(--pc-turquoise)] font-semibold tracking-wider">PERTANYAAN YANG SERING
                    DIAJUKAN</h3>
                <p class="mt-2 text-slate-500">Temukan jawaban atas pertanyaan umum seputar PlayCare.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ item 1 -->
                <div class="bg-white rounded-xl shadow soft-card p-5 cursor-pointer faq-item" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold text-slate-800">Apakah PlayCare tersedia di seluruh Indonesia?</h4>
                        <span class="text-[color:var(--pc-turquoise)] faq-icon">+</span>
                    </div>
                    <div class="mt-3 text-slate-600 faq-answer hidden">
                        Saat ini PlayCare sudah tersedia di beberapa kota besar di Indonesia dan terus berkembang ke
                        kota-kota lainnya.
                    </div>
                </div>

                <!-- FAQ item 2 -->
                <div class="bg-white rounded-xl shadow soft-card p-5 cursor-pointer faq-item" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold text-slate-800">Apakah data anak saya aman?</h4>
                        <span class="text-[color:var(--pc-turquoise)] faq-icon">+</span>
                    </div>
                    <div class="mt-3 text-slate-600 faq-answer hidden">
                        Semua data tersimpan secara terenkripsi dan hanya dapat diakses oleh orang tua dan mitra yang
                        berwenang.
                    </div>
                </div>

                <!-- FAQ item 3 -->
                <div class="bg-white rounded-xl shadow soft-card p-5 cursor-pointer faq-item" data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold text-slate-800">Bagaimana cara bergabung sebagai mitra daycare?</h4>
                        <span class="text-[color:var(--pc-turquoise)] faq-icon">+</span>
                    </div>
                    <div class="mt-3 text-slate-600 faq-answer hidden">
                        Anda bisa mendaftar melalui halaman "Gabung Mitra" dan tim kami akan memproses verifikasi serta
                        pelatihan onboarding.
                    </div>
                </div>

                <!-- FAQ item 4 -->
                <div class="bg-white rounded-xl shadow soft-card p-5 cursor-pointer faq-item" data-aos="fade-up"
                    data-aos-delay="500">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold text-slate-800">Apakah PlayCare gratis untuk orang tua?</h4>
                        <span class="text-[color:var(--pc-turquoise)] faq-icon">+</span>
                    </div>
                    <div class="mt-3 text-slate-600 faq-answer hidden">
                        PlayCare menyediakan layanan dasar gratis untuk orang tua. Fitur premium tertentu mungkin
                        berbayar.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LOCATION SECTION (DIPERBAIKI) -->
    <!-- LOCATION SECTION -->
    <section id="location" class="py-5 bg-light" style="transform: translateX(40px);">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary" style="font-size: 24px; font-weight: bold; color: #2bbec6;">Lokasi PlayCare</h2>
                <p class="text-muted" style="font-size: 20px;">Temukan lokasi kami di peta berikut.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <!-- Gunakan mx-auto untuk pusatkan horizontal -->
                    <div id="map" style="height: 380px; border-radius: 14px; overflow: hidden; transform: scale(0.7);" class="mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- TESTIMONI -->
    <section id="testimoni" class="py-16 bg-slate-50" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8 text-center" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-[color:var(--pc-turquoise)] font-semibold tracking-wider">APA KATA MEREKA</h3>
            <p class="mt-2 text-slate-500 mb-10">Pendapat para orang tua dan mitra tentang PlayCare</p>

            <div class="relative">
                <!-- Tombol kiri -->
                <button id="prevTesti"
                    class="absolute left-0 top-1/2 -translate-y-1/2 bg-white text-[color:var(--pc-turquoise)] w-10 h-10 rounded-full shadow hover:bg-[color:var(--pc-turquoise)] hover:text-white transition">
                    &lt;
                </button>

                <!-- Container Slider -->
                <div class="overflow-hidden">
                    <div id="sliderTesti" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Card 1 -->
                        <div class="min-w-full md:min-w-[50%] lg:min-w-[33.33%] px-3" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="bg-white p-6 rounded-xl shadow soft-card h-full flex flex-col justify-between">
                                <p class="text-slate-600 italic">“Aplikasi ini membantu banget buat pantau anak waktu di
                                    daycare. Laporannya lengkap dan real-time.”</p>
                                <div class="mt-4 text-left">
                                    <h4 class="font-semibold text-[color:var(--pc-turquoise)]">Rina Oktaviani</h4>
                                    <p class="text-sm text-slate-400">Orang Tua Anak Usia 4 Tahun</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="min-w-full md:min-w-[50%] lg:min-w-[33.33%] px-3" data-aos="fade-up"
                            data-aos-delay="300">
                            <div class="bg-white p-6 rounded-xl shadow soft-card h-full flex flex-col justify-between">
                                <p class="text-slate-600 italic">“PlayCare mempermudah administrasi di daycare kami.
                                    Transaksi dan laporan semuanya otomatis.”</p>
                                <div class="mt-4 text-left">
                                    <h4 class="font-semibold text-[color:var(--pc-turquoise)]">Maya Prameswari</h4>
                                    <p class="text-sm text-slate-400">Pemilik Daycare Ceria</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="min-w-full md:min-w-[50%] lg:min-w-[33.33%] px-3" data-aos="fade-up"
                            data-aos-delay="400">
                            <div class="bg-white p-6 rounded-xl shadow soft-card h-full flex flex-col justify-between">
                                <p class="text-slate-600 italic">“Fitur laporannya detail banget, jadi saya tahu anak
                                    makan apa, tidur berapa lama, dan belajar apa.”</p>
                                <div class="mt-4 text-left">
                                    <h4 class="font-semibold text-[color:var(--pc-turquoise)]">Santi Rahmawati</h4>
                                    <p class="text-sm text-slate-400">Ibu Rumah Tangga</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="min-w-full md:min-w-[50%] lg:min-w-[33.33%] px-3" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="bg-white p-6 rounded-xl shadow soft-card h-full flex flex-col justify-between">
                                <p class="text-slate-600 italic">“Bisa komunikasi langsung sama orang tua lewat
                                    aplikasi, sangat membantu sebagai pengasuh.”</p>
                                <div class="mt-4 text-left">
                                    <h4 class="font-semibold text-[color:var(--pc-turquoise)]">Tia Kusuma</h4>
                                    <p class="text-sm text-slate-400">Staff Daycare</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div class="min-w-full md:min-w-[50%] lg:min-w-[33.33%] px-3" data-aos="fade-up"
                            data-aos-delay="600">
                            <div class="bg-white p-6 rounded-xl shadow soft-card h-full flex flex-col justify-between">
                                <p class="text-slate-600 italic">“Desainnya lucu dan mudah digunakan. Anak saya jadi
                                    makin betah di daycare!”</p>
                                <div class="mt-4 text-left">
                                    <h4 class="font-semibold text-[color:var(--pc-turquoise)]">Andra Nugraha</h4>
                                    <p class="text-sm text-slate-400">Ayah 2 Anak</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol kanan -->
                <button id="nextTesti"
                    class="absolute right-0 top-1/2 -translate-y-1/2 bg-white text-[color:var(--pc-turquoise)] w-10 h-10 rounded-full shadow hover:bg-[color:var(--pc-turquoise)] hover:text-white transition">
                    &gt;
                </button>
            </div>
        </div>
    </section>

    <!-- CTA UNTUK ORANG TUA -->
    <section id="cta-parent" class="py-16 bg-[color:var(--pc-turquoise)] text-white" data-aos="fade-up"
        data-aos-easing="ease-in-out" data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8 text-center" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-semibold tracking-wider uppercase text-white/90">Untuk Orang Tua</h3>
            <h2 class="mt-2 text-4xl font-extrabold drop-shadow-lg">Bergabunglah dengan PlayCare Sekarang!</h2>
            <p class="mt-4 max-w-xl mx-auto text-white/90 leading-relaxed">
                Pantau aktivitas, transaksi, dan tumbuh kembang anak Anda dengan mudah dari genggaman.<br>
                Terhubung secara langsung dengan mitra daycare terpercaya.
            </p>
            <a href="{{ route('login') }}"
                class="mt-8 inline-block bg-white text-[color:var(--pc-turquoise)] font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-white/90 transition">
                Gabung Sekarang
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#259fa9] text-white mt-12" data-aos="fade-up" data-aos-easing="ease-in-out"
        data-aos-duration="700">
        <div class="max-w-site mx-auto px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tentang -->
            <div data-aos="fade-up" data-aos-delay="100">
                <h5 class="font-semibold mb-4">Tentang</h5>
                <p class="text-sm text-white/90 leading-relaxed">
                    PlayCare adalah aplikasi digital yang memudahkan pengasuhan anak secara terintegrasi bersama mitra
                    daycare dan layanan terpercaya.
                </p>
            </div>

            <!-- Navigasi -->
            <div data-aos="fade-up" data-aos-delay="200">
                <h5 class="font-semibold mb-4">Navigasi</h5>
                <ul class="space-y-2 text-white/90 text-sm">
                    <li><a href="#features" class="hover:underline">Fitur</a></li>
                    <li><a href="#tentang" class="hover:underline">Tentang</a></li>
                    <li><a href="#faq" class="hover:underline">FAQ</a></li>
                    <li><a href="{{ route('login') }}" class="hover:underline">Gabung</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div data-aos="fade-up" data-aos-delay="300">
                <h5 class="font-semibold mb-4">Kontak</h5>

                <ul class="space-y-3 text-white/90 text-sm">

                    <!-- Email -->
                    <li class="flex items-center space-x-3">
                        <!-- Ikon Email -->
                        <span class="p-2 bg-white/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        </span>

                        <!-- Teks -->
                        <a href="mailto:emajulia1509@gmail.com" class="hover:underline hover:text-white transition">
                            Email: support@playcare.id
                        </a>
                    </li>

                    <!-- WhatsApp -->
                    <li class="flex items-center space-x-3">
                        <!-- Ikon WA -->
                        <span class="p-2 bg-white/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 0 0-8.94 14.37L2 22l5.76-1.93A10 10 0 1 0 12 2z" />
                            </svg>
                        </span>

                        <!-- Teks -->
                        <a href="https://wa.me/6282315390811" target="_blank"
                            class="hover:underline hover:text-white transition">
                            WhatsApp: +62 823-1539-0811
                        </a>
                    </li>

                    <!-- Instagram -->
                    <li class="flex items-center space-x-3">
                        <!-- Ikon IG -->
                        <span class="p-2 bg-white/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        </span>

                        <!-- Teks -->
                        <a href="https://www.instagram.com/playcaree?utm_source=qr&igsh=MnNuc2o0ajE3ODh6" target="_blank"
                            class="hover:underline hover:text-white transition">
                            Instagram: @playcaree
                        </a>
                    </li>

                </ul>
            </div>


        </div>
        <div class="border-t border-white/30 text-center text-sm text-white/70 py-4" data-aos="fade-up"
            data-aos-delay="400">
            © <span id="year-footer"></span> PlayCare. Semua hak dilindungi.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            easing: 'ease-in-out',
            duration: 800,
            once: true,
        });

    </script>

    <script>
        // Mobile menu toggle
        const btnMobile = document.getElementById('btn-mobile');
        const mobileMenu = document.getElementById('mobile-menu');

        if (btnMobile && mobileMenu) {
            btnMobile.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // toggle fitur simple (switch active)
        const btnOrtu = document.getElementById('btn-orangtua');
        const btnMitra = document.getElementById('btn-mitra');
        const grid = document.getElementById('features-grid');

        if (btnOrtu && btnMitra) {
            btnOrtu.addEventListener('click', () => {
                btnOrtu.classList.add('toggle-active');
                btnOrtu.classList.remove('text-slate-600');
                btnMitra.classList.remove('toggle-active');
                btnMitra.classList.add('text-slate-600');
            });

            btnMitra.addEventListener('click', () => {
                btnMitra.classList.add('toggle-active');
                btnMitra.classList.remove('text-slate-600');
                btnOrtu.classList.remove('toggle-active');
                btnOrtu.classList.add('text-slate-600');
            });
        }

        // Update footer year
        const yearFooter = document.getElementById('year-footer');
        if (yearFooter) {
            yearFooter.textContent = new Date().getFullYear();
        }

    </script>


    <script>
        // FAQ toggle
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');
                answer.classList.toggle('hidden');
                icon.textContent = answer.classList.contains('hidden') ? '+' : '–';
            });
        });

    </script>

    <script>
        // === Infinite Testimoni Carousel ===
        const sliderTesti = document.getElementById("sliderTesti");
        const cards = sliderTesti.children;
        const prevBtn = document.getElementById("prevTesti");
        const nextBtn = document.getElementById("nextTesti");

        let index = 0;
        const total = cards.length;

        function updateSlide() {
            const width = cards[0].offsetWidth;
            sliderTesti.style.transform = `translateX(-${index * width}px)`;
        }

        nextBtn.addEventListener("click", () => {
            index = (index + 1) % total; // balik ke awal kalau di akhir
            updateSlide();
        });

        prevBtn.addEventListener("click", () => {
            index = (index - 1 + total) % total; // balik ke terakhir kalau di awal
            updateSlide();
        });

        // Responsive fix biar pas resize posisi tetap bener
        window.addEventListener("resize", updateSlide);

    </script>
</body>

</html>
