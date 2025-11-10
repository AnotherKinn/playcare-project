<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayCare - Loading</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes scaleIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 200% 200%;
            animation: gradientShift 6s ease infinite;
        }

        .scale-in {
            animation: scaleIn 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        .slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .shimmer-effect {
            position: relative;
            overflow: hidden;
        }

        .shimmer-effect::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .rotate-slow {
            animation: rotate 20s linear infinite;
        }

        .pulse-ring {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .ripple-effect {
            animation: ripple 2s ease-out infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

    </style>
</head>

<body class="overflow-hidden">
    <div id="splashScreen" class="fixed inset-0 gradient-bg flex items-center justify-center">
        <!-- Decorative Circles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-20 w-72 h-72 bg-purple-400 rounded-full opacity-20 blur-3xl float"></div>
            <div
                class="absolute bottom-20 right-20 w-96 h-96 bg-pink-400 rounded-full opacity-20 blur-3xl float delay-300">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-400 rounded-full opacity-10 blur-3xl float delay-200">
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 text-center px-6">
            <!-- Logo Container with Ripple Effect -->
            <div class="relative inline-block mb-8">
                <!-- Ripple Rings -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="absolute w-40 h-40 border-4 border-white rounded-full opacity-20 ripple-effect"></div>
                    <div
                        class="absolute w-40 h-40 border-4 border-white rounded-full opacity-20 ripple-effect delay-100">
                    </div>
                </div>

                <!-- Logo Circle -->
                <div class="scale-in relative">
                    <div
                        class="w-40 h-40 bg-white rounded-full shadow-2xl flex items-center justify-center shimmer-effect">
                        <!-- PlayCare Logo SVG -->
                        <svg class="w-24 h-24" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Baby Face -->
                            <circle cx="50" cy="50" r="35" fill="#FFD93D" />

                            <!-- Left Eye -->
                            <circle cx="42" cy="45" r="3" fill="#4A4A4A" />
                            <circle cx="43" cy="44" r="1.5" fill="white" />

                            <!-- Right Eye -->
                            <circle cx="58" cy="45" r="3" fill="#4A4A4A" />
                            <circle cx="59" cy="44" r="1.5" fill="white" />

                            <!-- Smile -->
                            <path d="M 40 55 Q 50 62 60 55" stroke="#4A4A4A" stroke-width="2.5" fill="none"
                                stroke-linecap="round" />

                            <!-- Rosy Cheeks -->
                            <circle cx="35" cy="52" r="5" fill="#FF9999" opacity="0.5" />
                            <circle cx="65" cy="52" r="5" fill="#FF9999" opacity="0.5" />

                            <!-- Pacifier -->
                            <circle cx="50" cy="65" r="8" fill="#A78BFA" opacity="0.8" />
                            <circle cx="50" cy="65" r="4" fill="#C4B5FD" />
                            <line x1="50" y1="65" x2="50" y2="72" stroke="#A78BFA" stroke-width="2" />
                            <circle cx="50" cy="73" r="2" fill="#A78BFA" />

                            <!-- Play Blocks -->
                            <g transform="translate(70, 25)">
                                <rect x="0" y="0" width="12" height="12" rx="2" fill="#FF6B9D" opacity="0.9" />
                                <text x="6" y="9" font-size="8" fill="white" text-anchor="middle"
                                    font-weight="bold">P</text>
                            </g>

                            <g transform="translate(15, 25)">
                                <rect x="0" y="0" width="12" height="12" rx="2" fill="#4ECDC4" opacity="0.9" />
                                <text x="6" y="9" font-size="8" fill="white" text-anchor="middle"
                                    font-weight="bold">C</text>
                            </g>
                        </svg>
                    </div>

                    <!-- Floating Stars -->
                    <div class="absolute -top-3 -right-3 float">
                        <svg class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>

                    <div class="absolute -bottom-3 -left-3 float delay-200">
                        <svg class="w-7 h-7 text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Brand Name -->
            <div class="slide-up delay-300">
                <h1 class="text-7xl font-extrabold text-white mb-3 tracking-tight drop-shadow-lg">
                    Play<span class="text-yellow-300">Care</span>
                </h1>
            </div>

            <!-- Tagline -->
            <div class="slide-up delay-400">
                <p class="text-xl text-purple-100 font-light mb-2">Tempat Bermain & Belajar Terbaik</p>
                <p class="text-sm text-purple-200 opacity-80">untuk Buah Hati Anda</p>
            </div>

            <!-- Feature Badges -->
            <div class="slide-up delay-500 flex justify-center gap-4 mt-8 mb-10">
                <div class="glass-effect rounded-full px-4 py-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-white text-sm font-medium">Aman</span>
                </div>

                <div class="glass-effect rounded-full px-4 py-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                    <span class="text-white text-sm font-medium">Edukatif</span>
                </div>

                <div class="glass-effect rounded-full px-4 py-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span class="text-white text-sm font-medium">Terpercaya</span>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div class="slide-up delay-600">
                <div class="inline-flex items-center gap-3">
                    <div class="w-2 h-2 bg-white rounded-full pulse-ring"></div>
                    <div class="w-2 h-2 bg-white rounded-full pulse-ring delay-100"></div>
                    <div class="w-2 h-2 bg-white rounded-full pulse-ring delay-200"></div>
                </div>
                <p class="text-white text-sm mt-4 opacity-75">Menyiapkan pengalaman terbaik...</p>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 w-80 slide-up delay-600">
            <div class="h-1.5 bg-white bg-opacity-20 rounded-full overflow-hidden backdrop-blur-sm">
                <div id="progressBar"
                    class="h-full bg-gradient-to-r from-yellow-300 via-pink-300 to-purple-300 rounded-full transition-all duration-300 ease-out shimmer-effect"
                    style="width: 0%"></div>
            </div>
            <p id="progressText" class="text-white text-xs text-center mt-2 opacity-70">0%</p>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 slide-up delay-600">
            <p class="text-white text-xs opacity-60">© 2024 PlayCare - Layanan Penitipan Anak Profesional</p>
        </div>
    </div>

    <script>
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const splashScreen = document.getElementById('splashScreen');
        let progress = 0;

        // 🔹 Cek apakah splash sudah pernah ditampilkan
        if (localStorage.getItem('splashShown')) {
            // Kalau sudah pernah tampil, langsung ke landing page
            window.location.href = '/landing-page';
        } else {
            // Tandai bahwa splash sudah pernah ditampilkan
            localStorage.setItem('splashShown', 'true');

            // Jalankan animasi progress bar
            const progressInterval = setInterval(() => {
                progress += 1;
                progressBar.style.width = progress + '%';
                progressText.textContent = progress + '%';

                if (progress >= 100) {
                    clearInterval(progressInterval);

                    setTimeout(() => {
                        splashScreen.classList.add('fade-out');

                        setTimeout(() => {
                            // Redirect ke landing page
                            window.location.href = '/landing-page';
                        }, 3000);
                    }, 3000);
                }
            }, 25);
        }

        // 🔹 Prevent back button (opsional)
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };

    </script>


</body>

</html>
