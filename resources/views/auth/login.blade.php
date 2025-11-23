<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — PlayCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #2bbec6;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #48d1d6 100%);
        }

        .form-shadow {
            box-shadow: 0 10px 30px rgba(43, 190, 198, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex bg-white">

    <!-- Sisi Kiri -->
    <div class="hidden md:flex w-1/2 gradient-bg items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://i.pinimg.com/1200x/90/92/51/909251d428c5c1ab4de627aef0b8db75.jpg')] bg-cover bg-center opacity-20"></div>
        <div class="relative z-10 text-center text-white p-10">
            <img src="{{ asset('assets/images/logo-playcare.png') }}"
                alt="PlayCare Logo"
                style="transform: scale(1.3);"
                class="mx-auto w-32 h-32 mb-6 rounded-full border-4 border-white shadow-lg object-cover">
            <h1 class="text-4xl font-extrabold tracking-tight">Selamat Datang di <span class="text-white">PlayCare</span></h1>
            <p class="mt-4 text-lg font-light max-w-md mx-auto">Platform yang membantu orang tua memantau aktivitas anak dengan mudah dan menyenangkan.</p>
        </div>
    </div>

    <!-- Sisi Kanan -->
    <div class="flex w-full md:w-1/2 items-center justify-center p-8 md:p-16 bg-white">
        <div class="w-full max-w-md form-shadow bg-white rounded-2xl p-8 md:p-10">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Masuk ke Akun</h2>

            @if (session('status'))
                <div class="mb-6 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email Anda">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password Anda">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                {{-- <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember"
                        class="h-4 w-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)]">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700 cursor-pointer">Ingat saya</label>
                </div> --}}

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-[var(--primary)] hover:bg-[#26aeb5] text-white font-semibold rounded-full py-3 shadow-md transition duration-300">
                    Masuk
                </button>

                <!-- Links -->
                <div class="text-center text-sm text-gray-600 mt-4">
                    <div class="mt-2">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-[var(--primary)] font-semibold hover:underline">Daftar di sini</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert -->
    @if (session('loginError'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: "{{ session('loginError') }}",
                confirmButtonColor: '#2bbec6',
                confirmButtonText: 'Coba Lagi',
            });
        </script>
    @endif

</body>
</html>
